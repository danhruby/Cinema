<?php

namespace App\Presenters;

use Kdyby\Autowired\AutowireComponentFactories,
    Nette,
    App\Model,
    Kdyby\Doctrine\EntityManager;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @var EntityManager
     * @inject
     */
    public $em;

    use AutowireComponentFactories;
}
