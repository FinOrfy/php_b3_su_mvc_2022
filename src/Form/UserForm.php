<?php

namespace App\Form;

use App\Entity\User;


class UserForm
{

    public $contentForm = ''; 

    public function __construct(array $optionsForms) {

        foreach ($optionsForms as $optionsForm) {
            $this->contentForm .= $this->buildElementForm($optionsForm);
          }         
    
    } 

    public function getContentForm(): void {

       echo $this->contentForm;          
    
    } 
    public function buildElementForm(array $options): string
    {        

            $elementForm = '<';

            if(isset($options['nomElementForm']) && !empty($options['nomElementForm'])){

                $elementForm .= $options['nomElementForm'];

            }

            if(isset($options['typeElementForm']) && !empty($options['typeElementForm'])){

                $elementForm .= ' type="'.$options['typeElementForm'].'"';

            }

            if(isset($options['nameElementForm']) && !empty($options['nameElementForm'])){

                $elementForm .= ' name="'.$options['nameElementForm'].'"';

            }

            if(isset($options['idElementForm']) && !empty($options['idElementForm'])){

                $elementForm .= ' id="'.$options['idElementForm'].'"';

            }

            if(isset($options['classElementForm']) && !empty($options['classElementForm'])){

                $elementForm .= ' class="'.$options['classElementForm'].'"';

            }

            if(isset($options['forElementForm']) && !empty($options['forElementForm'])){

                $elementForm .= 'for ="'.$options['forElementForm'].'">';

            }

            if(isset($options['valueElementForm']) && !empty($options['valueElementForm'])){

                $elementForm .= 'value ="'.$options['valueElementForm'].'">';
            }

            $elementForm .= '>';

            if(isset($options['endElementForm']) && !empty($options['endElementForm'])){

                $elementForm .= $options['endElementForm'];
            }

            return  $elementForm;
              
        
    }

   
}