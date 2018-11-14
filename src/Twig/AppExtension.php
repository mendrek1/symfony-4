<?php
/**
 * Created by PhpStorm.
 * User: MenDreK
 * Date: 11.07.2018
 * Time: 11:09
 */

namespace App\Twig;


use App\Entity\LikeNotification;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig_SimpleTest;

class AppExtension extends AbstractExtension implements GlobalsInterface
{

    /**
     * @var string
     */
    private $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'priceFilter'])
        ];
    }

    public function getGlobals()
    {
        return[
            'locale' => $this->locale
        ];
    }
    public function priceFilter($number)
    {
        return '$'.number_format($number,2,'.',',');
    }

    public function getTests(){
        return [
            new Twig_SimpleTest(
                'like',
                function ($obj){ return $obj instanceof LikeNotification;}
                )
        ];
    }
}