<?php

use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getData() as $value =>  $data)
        {
            $sector = new \App\Sectors();

            $sector->name = $data['name'];
            $sector->value = $value;

            if (isset($data['parent'])) {
                $parent = \App\Sectors::where('value', $data['parent'])->first(['id']);
                $sector->parent_id = $parent->id;
            }

            $sector->save();
        }
    }

    public function getData()
    {
        return [
            '1' => ['name' => 'Manufacturing'],
            '19' => ['name' => 'Construction materials', 'parent' => 1],
            '18' => ['name' => 'Electronics and Optics', 'parent' => 1],
            '6' => ['name' => 'Food and Beverage', 'parent' => 1],
            '342' => ['name' => 'Bakery &amp; confectionery products', 'parent' => 6],
            '43' => ['name' => 'Beverages', 'parent' => 6],
            '42' => ['name' => 'Fish &amp; fish products', 'parent' => 6],
            '40' => ['name' => 'Meat &amp; meat products', 'parent' => 6],
            '39'=> ['name' => 'Milk &amp; dairy products', 'parent' => 6],
            '437' => ['name' => 'Other', 'parent' => 6],
            '378' => ['name' => 'Sweets &amp; snack food', 'parent' => 6],
            '13' => ['name' => 'Furniture', 'parent' => 1],
            '389'  => ['name' => 'Bathroom/sauna ', 'parent' => 13],
            '385'  => ['name' => 'Bedroom', 'parent' => 13],
            '390'  => ['name' => 'Children’s room', 'parent' => 13],
            '98'  => ['name' => 'Kitchen', 'parent' => 13],
            '101'  => ['name' => 'Living room', 'parent' => 13],
            '392'  => ['name' => 'Office', 'parent' => 13],
            '394'  => ['name' => 'Other (Furniture)', 'parent' => 13],
            '341'  => ['name' => 'Outdoor', 'parent' => 13],
            '99' => ['name' => 'Project furniture', 'parent' => 1],
            '12' => ['name' => 'Machinery', 'parent' => 1],
            '94' => ['name' => 'Machinery components', 'parent' => 12],
            '91' => ['name' => 'Machinery equipment/tools', 'parent' => 12],
            '224' => ['name' => 'Manufacture of machinery', 'parent' => 12],
            '97' => ['name' => 'Maritime', 'parent' => 12],
            '271' => ['name' => 'Aluminium and steel workboats', 'parent' => 97],
            '269' => ['name' => 'Boat/Yacht building', 'parent' => 97],
            '230' => ['name' => 'Ship repair and conversion', 'parent' => 97],
            '93' => ['name' => 'Metal structures', 'parent' => 12],
            '508' => ['name' => 'Other', 'parent' => 12],
            '227' => ['name' => 'Repair and maintenance service', 'parent' => 12],
            '11' => ['name' => 'Metalworking', 'parent' => 1],
            '67' => ['name' => 'Construction of metal structures', 'parent' => 11],
            '263' => ['name' => 'Houses and buildings', 'parent' => 11],
            '267' => ['name' => 'Metal products', 'parent' => 11],
            '542' => ['name' => 'Metal works', 'parent' => 11],
            '75' => ['name' => 'CNC-machining', 'parent' => 542],
            '62' => ['name' => 'Forgings, Fasteners', 'parent' => 542],
            '69' => ['name' => 'Gas, Plasma, Laser cutting', 'parent' => 542],
            '66' => ['name' => 'MIG, TIG, Aluminum welding', 'parent' => 542],
            '9' => ['name' => 'Plastic and Rubber', 'parent' => 1],
            '54' => ['name' => 'Packaging', 'parent' => 9],
            '556' => ['name' => 'Plastic goods', 'parent' => 9],
            '559' => ['name' => 'Plastic processing technology', 'parent' => 9],
            '55' => ['name' => 'Blowing', 'parent' => 559],
            '57' => ['name' => 'Moulding', 'parent' => 559],
            '53' => ['name' => 'Plastics welding and processing', 'parent' => 559],
            '560' => ['name' => 'Plastic profiles', 'parent' => 9],
            '5' => ['name' => 'Printing', 'parent' => 1],
            '148' => ['name' => 'Advertising', 'parent' => 5],
            '150' => ['name' => 'Book/Periodicals printing', 'parent' => 5],
            '145' => ['name' => 'Labelling and packaging printing', 'parent' => 5],
            '7' => ['name' => 'Textile and Clothing', 'parent' => 1],
            '44' => ['name' => 'Clothing', 'parent' => 7],
            '45' => ['name' => 'Textile', 'parent' => 7],
            '8' => ['name' => 'Wood', 'parent' => 1],
            '337' => ['name' => 'Other (Wood)', 'parent' => 8],
            '51' => ['name' => 'Wooden building materials', 'parent' => 8],
            '47' => ['name' => 'Wooden houses', 'parent' => 8],
            '3' => ['name' => 'Other'],
            '37' => ['name' => 'Creative industries', 'parent' => 3],
            '29' => ['name' => 'Energy technology', 'parent' => 3],
            '33' => ['name' => 'Environment', 'parent' => 3],
            '2' => ['name' => 'Service'],
            '25' => ['name' => 'Business services', 'parent' => 2],
            '35' => ['name' => 'Engineering', 'parent' => 2],
            '28' => ['name' => 'Information Technology and Telecommunications', 'parent' => 2],
            '581' => ['name' => 'Data processing, Web portals, E-marketing', 'parent' => 28],
            '576' => ['name' => 'Programming, Consultancy', 'parent' => 28],
            '121' => ['name' => 'Software, Hardware', 'parent' => 28],
            '122' => ['name' => 'Telecommunications', 'parent' => 28],
            '22' => ['name' => 'Tourism', 'parent' => 2],
            '141' => ['name' => 'Translation services', 'parent' => 2],
            '21' => ['name' => 'Transport and Logistics', 'parent' => 2],
            '111' => ['name' => 'Air', 'parent' => 21],
            '114' => ['name' => 'Rail', 'parent' => 21],
            '112' => ['name' => 'Road', 'parent' => 21],
            '113' => ['name' => 'Water', 'parent' => 21],
        ];
    }
}
