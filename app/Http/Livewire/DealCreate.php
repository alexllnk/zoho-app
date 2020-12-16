<?php

namespace App\Http\Livewire;

use App\Clients\ZOHOClient;
use App\Models\Deal;
use Livewire\Component;

class DealCreate extends Component
{
    public $saveDealSuccess;
    public $saveTaskSuccess;
    public $deal;

    private $zohoClient;
    private $successStatuses = [200, 201];

    public function __construct()
    {
        parent::__construct();
        $this->zohoClient = new ZOHOClient();
    }

    protected $rules = [
        'deal.name' => 'required',
        'deal.task_subject' => 'required'
    ];

    public function mount()
    {
        $this->deal = new Deal();
    }

    public function saveDeal()
    {
        $this->validate();

        $this->zohoClient->init();

        //Create deal
        $resCreateDeal = $this->zohoClient->createDeals($this->deal->name, $this->deal->task_subject);
        if (in_array($resCreateDeal['status'], $this->successStatuses)) {
            $this->saveDealSuccess = 'success';
        } else {
            $this->saveDealSuccess = 'fail';
        }

        //Create task
        if (!empty($resCreateDeal['dealID'])) {
            $resCreateTask = $this->zohoClient->createTasks($this->deal->task_subject, $resCreateDeal['dealID']);
            if (in_array($resCreateTask['status'], $this->successStatuses)) {
                $this->saveTaskSuccess = 'success';
            }
        }
        if (empty($this->saveTaskSuccess)) {
            $this->saveTaskSuccess = 'fail';
        }


    }

    public function render()
    {
        return view('livewire.deal-create')->layout('layouts.app', ['header' => 'Create deals']);;
    }
}
