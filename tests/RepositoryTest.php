<?php

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;

class RepositoryTest extends TestCase
{
    use CreatesApplication;
    
    /** @test */
    public function it_creates_a_repository_directory_and_repository_class ()
    {
        $this->assertFalse(is_dir(app_path('Repositories')));

        Artisan::call('onethirtyone:make-repository', ['name' => 'otoTest']);

        $this->assertTrue(is_dir(app_path('Repositories')));
        $this->assertTrue(is_file(app_path('Repositories/otoTestRepository.php')));

        unlink(app_path('Repositories/otoTestRepository.php'));
        if (count(scandir(app_path('Repositories'))) == 2) {
            rmdir(app_path('Repositories'));
        }
    }

    /** @test */
    public function it_creates_a_model_when_the_option_is_set ()
    {
        $this->assertFalse(is_file(app_path('otoTest.php')));

        Artisan::call('onethirtyone:make-repository', ['name' => 'otoTest', '-m' => true]);

        $this->assertTrue(is_file(app_path('otoTest.php')));

        unlink(app_path('Repositories/otoTestRepository.php'));
        unlink(app_path('otoTest.php'));
        if (count(scandir(app_path('Repositories'))) == 2) {
            rmdir(app_path('Repositories'));
        }
    }


}