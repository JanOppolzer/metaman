<?php

namespace App\Jobs;

use App\Mail\ExceptionOccured;
use App\Models\Entity;
use App\Models\Federation;
use App\Models\User;
use App\Traits\GitTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GitDeleteFromFederation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GitTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Entity $entity,
        public Federation $federation,
        public User $user
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $git = $this->initializeGit();

        $tagfile = $this->federation->tagfile;
        $content = Storage::get($tagfile);
        $content = preg_replace('#'.$this->entity->entityid.'#', '', $content);
        Storage::put($tagfile, $content);
        $this->trimWhiteSpaces($tagfile);

        if ($git->hasChanges()) {
            $git->addFile($tagfile);

            $git->commit(
                $this->committer().": $tagfile (update)\n\n"
                    ."Updated by: {$this->user->name} ({$this->user->uniqueid})\n"
            );

            $git->push();
        }
    }

    public function failed(Throwable $exception)
    {
        Log::critical("Exception occured in {$exception->getFile()} on line {$exception->getLine()}: {$exception->getMessage()}");
        Log::channel('slack')->critical("Exception occured in {$exception->getFile()} on line {$exception->getLine()}: {$exception->getMessage()}");

        Mail::to(config('mail.admin.address'))->send(new ExceptionOccured([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]));
    }
}
