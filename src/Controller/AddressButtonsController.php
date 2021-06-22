<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressButtonsController extends AbstractController
{
  public function AddressButtons(): string
  {
    $text='<div class=\"icon\"><a href=\"https://vk.com/alinok2708\" target=\"_blank\"><img src=\" {{ asset(\'images/16.png\') }}\" width=\"40\"
     height=\"40\" alt=\"Вконтакте\" class=\"turn2\"></a>
    <a href=\"https://ok.ru/profile/561888763851\" target=\"_blank\"><img src=\"{{ asset(\'images/22.png\') }}\" width=\"40\"
     height=\"40\" alt=\"Одноклассники\" class=\"turn2\"></a>
     <a href=\"https://instagram.com/alinok17_20\" target=\"_blank\"><img src=\"{{ asset(\'images/21.png\') }}\" width=\"40\"
     height=\"40\" alt=\"Инстграм\" class=\"turn2\"></a>
    </div>';

    return $text;
  }
}
