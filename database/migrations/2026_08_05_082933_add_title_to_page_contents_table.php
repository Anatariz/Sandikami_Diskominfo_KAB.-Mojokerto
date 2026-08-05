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
        Schema::table('page_contents', function (Blueprint $table) {
            $table->string('title')->nullable()->after('slug');
        });

        // Migrate existing data (extract <h2> to title, strip <p>)
        $pages = \Illuminate\Support\Facades\DB::table('page_contents')->get();
        foreach ($pages as $page) {
            $title = '';
            $content = $page->content;
            
            if (preg_match('/<h2>(.*?)<\/h2>/', $content, $matches)) {
                $title = $matches[1];
                $content = preg_replace('/<h2>.*?<\/h2>/', '', $content);
            }
            
            $content = str_replace(['<p>', '</p>'], ['', "\n"], $content);
            $content = trim($content);
            
            \Illuminate\Support\Facades\DB::table('page_contents')
                ->where('id', $page->id)
                ->update(['title' => $title, 'content' => $content]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
