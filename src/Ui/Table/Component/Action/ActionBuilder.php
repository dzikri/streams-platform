<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ActionBuilder
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 * @package Anomaly\Streams\Platform\Ui\Table\Component\Action
 */
class ActionBuilder
{

    /**
     * The action reader.
     *
     * @var ActionInput
     */
    protected $input;

    /**
     * The action factory.
     *
     * @var ActionFactory
     */
    protected $factory;

    /**
     * Create a new ActionBuilder instance.
     *
     * @param ActionInput   $input
     * @param ActionFactory $factory
     */
    public function __construct(ActionInput $input, ActionFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the actions.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        $table = $builder->getTable();

        $this->input->read($builder);

        foreach ($builder->getActions() as $action) {
            if (array_get($action, 'enabled', true)) {
                $table->addAction($this->factory->make($action));
            }
        }
    }
}
