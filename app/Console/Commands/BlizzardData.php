<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


const BLIZZARDURL = "https://us.api.blizzard.com/d3/data/";
const LOCALE="?locale=en_US";
const TOKEN="USzaYSgp3J4fc1JgCUEIoLm7Zl6L5oMB1P";
class BlizzardData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:BlizzardDownload {Type}{parameter?}{--create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $category = "";
        $data = "";
        //$item = self::GetItem();

        $DataType = $this->argument('Type');
        
        $parameter = $this->argument('parameter');

        $url = BLIZZARDURL;
        switch($DataType)
        {
            
            case "GetToken":
                Self::GetToken();
                break;
            case "GenerateItems":
                Self::CreateItems();
                break;
            case "GetItemTypes":    //Creates a list of all Item types
                
                Self::GetAllItemTypes();
                break;
            case "GetItemType":    //Get all items of a specific type
                Self::GetItemType($parameter);
                break;
            case "GetItem":
                Self::GetItem($parameter);
                break;
        }

        return 0;
    }

    /**
    * creates a json file with all item types
    */
    public function GetAllItemTypes()
    {   
        echo ("item types: \n");
        $url = BLIZZARDURL."item-type".LOCALE;
        
        $ch = curl_init($url);
        //set up header
        $headers[] = 'Accept: application/json'; 
        $headers[] = 'Authorization: Bearer ' . TOKEN;

        //var_dump($headers);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        
        $response = curl_exec($ch);
        
        curl_close($ch);


        $decode=  json_decode($response, true);
        $encode = json_encode($decode);

        
        
       Storage::disk('public')->put("Data/Item/ItemTypes.json", $encode, 'public');
       return ($response);

        
    }

    /**
     * Creates a json file  with a list of items of a specific type, must match an id as seen in GetAllItemTypes
     * @param string must match the slug of an existing item type, other wise will return 404
     */
    public function GetItemType($type)
    {
        $url = BLIZZARDURL."item-type/".$type.LOCALE;    
        


        $ch = curl_init($url);

        

        //set up header
        $headers[] = 'Accept: application/json'; 
        $headers[] = 'Authorization: Bearer ' . TOKEN;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        $decode=  json_decode($response, true);
        $encode = json_encode($decode);
        //echo $response;
        Storage::disk('public')->put("Data/".$type.".json", $encode, 'public');
        return $response;
        
    }

    public function CreateItems()
    {

        //get a list of item types
        $path = Self::GetAllItemTypes();        
        $itemTypes = json_decode($path, false);
        
        
        
        foreach ($itemTypes as $key=>$value) {
            
            self::CreateItemType($value);
            
            
            
        }

    }

    public function CreateItemType($type)
    {
        //create the file containing all of the item's type
        $path = Storage::disk('public')->put("Data/ItemType/".$type->id.".json", json_encode($type), 'public');

        
        $slug = strtolower($type->id);   
        $slug = str_replace("_", "", $slug);     
        //echo $slug;
        $path = Self::GetItemType($slug);
        $item = json_decode($path, false);
        
       foreach($item as $key=>$value)
        {
            self::CreateItem($value);
        }
        
        
    }

    public function CreateItem($type)
    {     
        
        //var_dump($type);
        $item = json_encode($type);
        
        $path = Storage::disk('public')->put("Data/ItemType/Item/".$type->id.".json", ($item), 'public');

        //echo $path . "\n";
    }

    
    //http://media.blizzard.com/d3/icons/items/large/actiq2_ratmageskull_demonhunter_male.png
    public function GetIcon($type = "items", $size = "large", $icon)
    {
        $url = "http://media.blizzard.com/d3/icons/$type/$size/$icon.png";
        
        $ch = curl_init($url);
        //set up header
        $headers[] = 'Accept: application/json'; 
        $headers[] = 'Authorization: Bearer ' . TOKEN;

        //var_dump($headers);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        
        $response = curl_exec($ch);
        
        curl_close($ch);
        return null;    
    }

        
    /**
     * Creates a json file  with the details of a specific item
     *
     *  @param string must match format item_slug-item_id as seen in an item types json file
     */
    
    public function GetItem($item)
    {

        
        echo("Attempting to add " .$item. "\n");
        $url = BLIZZARDURL."item/".$item.LOCALE;
        $url = "https://us.api.blizzard.com/d3/data/item/".$item."?locale=en_US";

        
        //$token = self::CreatedToken()['token'];
        $token ="US2g5NRpuDtCh1riTrES8vfbk07TZSdabX";

        $ch = curl_init($url);

        

        //set up header
        $headers[] = 'Accept: application/json'; 
        $headers[] = 'Authorization: Bearer ' . TOKEN;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        
        $decode=  json_decode($response, true);
        $encode = json_encode($decode);

        Storage::disk('public')->put("Data/Item/Items/".$item.".json", $encode, 'public');
        
    }

    public function GetToken()
    {

        $APICLIENT= env('BLIZZARD_API_CLIENT', false);
        $APISECRET= env('BLIZZARD_API_SECRET', false);

        $params = array(
            'grant_type' =>'client_credentials'
        
        );

        $url = "https://us.api.blizzard.com/d3/data/act?locale=en_US";

        $tokenUri = "https://oauth.battle.net/token";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_USERPWD, $APICLIENT . ":" . $APISECRET);
        curl_setopt($ch, CURLOPT_URL, $tokenUri);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $accessTokenResponse = json_decode($response, true);


    
        if(isset($accessTokenResponse['access_token']))
        {
            $status = 'ok';
            $message = 'message generated';
        }
        else
        {
            $status = 'not okay';
            $message = "token not generated";
            echo "fail";
            die;
        }
        
        $token = $accessTokenResponse['access_token'];
        $arr[] = array(
            'message' => $message,
            'Status' => $status,
            'token' => $token
            
            );

        //$arr['Status'] = $status;
        //$arr['message'] = $M;

        
        var_dump( arr);
    }
}

    