<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            DB::table('users')
            ->where('id', 1)
            ->update([
                'name' => '栄郁矢',
                'email'=> 'bdarsm.zero4@icloud.com',
                'password'=>"sakae24182904"
            ]);
            DB::table('users')
            ->where('id', 2)
            ->update([
                'name' => '田原志',
                'email'=> 'nozomu.tahara4@icloud.com',
                'password'=>"tahara0703"
            ]);
            DB::table('users')
            ->where('id', 3)
            ->update([
                'name' => '犬山一飛',
                'email'=> 'kazuhi.inuyama@icloud.com',
                'password'=>"inuyama0703"
            ]);
            DB::table('users')
            ->where('id', 4)
            ->update([
                'name' => '数井哲',
                'email'=> 'tetsy.kazui@icloud.com',
                'password'=>"kazui0703"
            ]);
            DB::table('users')
            ->where('id', 5)
            ->update([
                'name' => 'スタンリー',
                'email'=> 'stanly@icloud.com',
                'password'=>"stanly0703"
            ]);
            DB::table('users')
            ->where('id', 6)
            ->update([
                'name' => 'ライ',
                'email'=> 'rai@icloud.com',
                'password'=>"rai0703"
            ]);
            DB::table('users')
            ->where('id', 7)
            ->update([
                'name' => 'ビクラム',
                'email'=> 'viclum@icloud.com',
                'password'=>"viclum0703"
            ]);
            DB::table('users')
            ->where('id', 8)
            ->update([
                'name' => 'ソエブ',
                'email'=> 'soebu@icloud.com',
                'password'=>"soebu0703"
            ]);
            DB::table('users')
            ->where('id', 9)
            ->update([
                'name' => '中川原大和',
                'email'=> 'yamato_nakagawara@icloud.com',
                'password'=>"nakagawara0703"
            ]);
            DB::table('users')
            ->where('id', 10)
            ->update([
                'name' => '濵田尚志',
                'email'=> 'takashi.hamada@icloud.com',
                'password'=>"hamada0703"
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            DB::table('users')
            ->where('id', 1)
            ->update([
                'name' => 'Kenny Leannon',
                'email'=> 'koss.reinhold@example.com',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 2)
            ->update([
                'name' => 'Mr. Kelton Torp I',
                'email'=> 'green.nayeli@example.org',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 3)
            ->update([
                'name' => 'Marcelo Wintheiser',
                'email'=> 'lemke.maybelle@example.org',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 4)
            ->update([
                'name' => 'Dr. Amos Eichmann',
                'email'=> 'winfield.purdy@example.org',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 5)
            ->update([
                'name' => 'Rolando Bins',
                'email'=> 'smaria.reilly@example.net',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 6)
            ->update([
                'name' => 'Eleanore Bergstrom',
                'email'=> 'damore.celestino@example.org',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 7)
            ->update([
                'name' => 'Alexanne Dickens',
                'email'=> 'koelpin.elmer@example.org',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 8)
            ->update([
                'name' => 'Ashlee Upton MD',
                'email'=> 'mertz.jena@example.net',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 9)
            ->update([
                'name' => 'Mrs. Virginia Jones III',
                'email'=> 'claude30@example.com',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);
            DB::table('users')
            ->where('id', 10)
            ->update([
                'name' => 'Christelle Padberg',
                'email'=> 'jordan.keebler@example.com',
                'password'=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]);

        });
    }
};
