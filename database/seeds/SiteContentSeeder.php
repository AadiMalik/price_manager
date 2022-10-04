<?php

use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Home Page', 'Home Page', 'Home Page', 'Home Page', 'Home Page', 'Home Page', 'Home Page',
            'Brand Page', 'Brand Page',
            'Contraction Help Page', 'Contraction Help Page',
            'Remarks Page',
            'Package Page', 'Package Page',
            'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page', 'Contact Page',
            'About Page','About Page',
            'Footer Logo','Footer Address','Footer Phone Number','Footer Web Link','Footer Time',
            'Home Page Carousel',
            'Logo',
            'Home Page Carousel','Home Page Carousel','Home Page Carousel','Home Page Carousel','About Page'];

        $headingNames = ['Popular Brand', 'Popular Brand Text', 'Find Heading', 'Find Paragraph', 'Find Industry Heading', 'Find City Heading', 'Find Type Heading',
            'All Popular Brand', 'All Popular Brand Paragraph',
            'Contraction Help Header Text', 'Our Customer Remarks Heading',
            'Remarks Heading',
            'Package Page Heading', 'Package Page Paragraph',
            'Contact Heading', 'Contact Form Heading', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form', 'Contact Form',
            'About Heading','About Paragraph',
            'Footer Heading','Footer Address','Footer Phone Number','Footer Web Link','Footer Time Table',
            'Home Page Carousel Image',
            'Home Page Logo',
            'Home Page Carousel Image','Home Page Carousel Image','Home Page Carousel Image','Home Page Carousel Image','About description'];
        foreach ($pages as $index => $page){
            DB::table('site_contents')->insert([
                'user_id' => 1,
                'page' => $page,
                'heading_name' => $headingNames[$index],
                'content' => 'abc',
            ]);
        }


    }
}
