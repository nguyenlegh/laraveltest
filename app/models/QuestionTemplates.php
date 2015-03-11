<?php

/**
 * QuestionTemplates entity
 * @author nguyenle
 *
 */
class QuestionTemplates extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'question_templates';
    
    /** no timestamp */
    public $timestamps = false;
}