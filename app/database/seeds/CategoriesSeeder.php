<?php
/**
 * Categories seed
 * @author nguyenle
 *
 */
class CategoriesSeeder extends Seeder {
    protected $TEMPLATES = array(
        'Food',
        'Place',
        'Shop',
        'Transportation',
        'Events',
        'Others'
    );

    /**
     * Run the seeder
     */
    public function run() {
        Eloquent::unguard ();
        
        foreach ($this->TEMPLATES as $value) {
            $qt = new Categories();
            $qt->title = $value;
            $qt->save();
        }
    }
}