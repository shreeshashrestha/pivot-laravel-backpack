<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Http\Requests\AttendanceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AttendanceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttendanceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Attendance');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attendance');
        $this->crud->setEntityNameStrings('attendance', 'attendances');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $cols=[
            [
                'name' => 'abc_id',
                'type' => 'number',
                'label' =>'abc'
            ],
            
                // [
                //     'name'  => 'employees.employee_id',
                //     'label' => 'Employee Name',
                //     'type'  => 'text',
                // ],
            [
                //Select2Multiple = n-n relationship (with pivot table)
                'label'     => "Employees Names",
                'type'      => 'select2',
                'name'      => 'employees', // the method that defines the relationship in your Model
                'entity'    => 'employees', // the method that defines the relationship in your Model
                'attribute' => 'employee_id', // foreign key attribute that is shown to user
                'model'     => "App\Models\Employee", // foreign key model
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ]
        ];
        $this->crud->addColumns($cols);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AttendanceRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $arr=[
            [
                'name' => 'abc_id',
                'type' => 'number',
                'label' =>'abc'
            ],
            [    // Select2Multiple = n-n relationship (with pivot table)
                'label'     => "Employees Names",
                'type'      => 'select2_multiple',
                'name'      => 'employees', // the method that defines the relationship in your Model
                'entity'    => 'employees', // the method that defines the relationship in your Model
                'attribute' => 'emp_name', // foreign key attribute that is shown to user
                'model'     => "App\Models\Employee", // foreign key model
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                'select_all' => true, // show Select All and Clear buttons?
           ]
        ];
        $this->crud->addFields($arr);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
