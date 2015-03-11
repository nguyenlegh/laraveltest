<?php
/**
 * Question template seed
 * @author nguyenle
 *
 */
class QuestionTemplatesSeeder extends Seeder {
    protected $TEMPLATES = array(
        'What is...',
        'Where is...',
        'How to...',
        'How do I...',
        'Can I...',
        'When is...'
    );

    /**
     * Run the seeder
     */
    public function run() {
        Eloquent::unguard ();
        
        foreach ($this->TEMPLATES as $value) {
            $qt = new QuestionTemplates();
            $qt->content = $value;
            $qt->save();
        }
    }
}