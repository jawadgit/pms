<?php 

namespace App\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\Routing\RouteCollection;

class PropertyController extends Controller
{
	public function __construct()
    {
        $this->propertyModel = $this->model('Properties');
    }

	public function index(RouteCollection $routes)
	{
		$data = $this->propertyModel->getData();
		if(empty($data)){
			$this->importData();
		}
		$this->view('home', $data);
	}

	private function importData()
	{
		set_time_limit(0);
		$client = new \GuzzleHttp\Client();
		$request = $client->get('https://trial.craig.mtcserver15.com/api/properties?api_key='.API_KEY.'&page[size]='.PAGE_SIZE.'&page[number]=1');
		$response = $request->getBody()->getContents();	
		$decodedData = json_decode($response);

		for($i=1; $i<=TOTAL_PAGES; $i++)
		{
			$request = $client->get('https://trial.craig.mtcserver15.com/api/properties?api_key='.API_KEY.'&page[size]='.PAGE_SIZE.'&page[number]='.$i);
			$response = $request->getBody()->getContents();	
			$decodedData = json_decode($response);
			$decodedDataArray = $decodedData->data;
			foreach($decodedDataArray as $data)
			{
				$result = $this->propertyModel->getPropertyType($data->property_type->title);
				if($result == '')
				{
					$savePropertyTypeResult = $this->propertyModel->savePropertyTpe($data->property_type);
					$savePropertyResult = $this->propertyModel->saveProperty($data, $savePropertyTypeResult);
				}else{
					$savePropertyResult = $this->propertyModel->saveProperty($data, $result->id);
				}
			}
		}
		return true;
	}
}
