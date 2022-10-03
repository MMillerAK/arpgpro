<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


const BLIZZARDURL = "https://us.api.blizzard.com/d3/data";
const LOCALE="?locale=en_US";
const TOKEN="";
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
            case "AllItemTypes":    //Creates a list of all Item types
                
                Self::GetAllItemTypes();
                break;
            case "ItemType":    //Get all items of a specific type
                Self::GetItemType($parameter);
                break;
            case "Item":
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
        $url = BLIZZARDURL."item-type".LOCALE;
        $ch = curl_init($url);
        //set up header
        $headers[] = 'Accept: application/json'; 
        $headers[] = 'Authorization: Bearer ' . $TOKEN;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        $decode=  json_decode($response, true);
        $encode = json_encode($decode);

        Storage::disk('public')->put("Data/Item/ItemTypes.json", $encode, 'public');

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
        $headers[] = 'Authorization: Bearer ' . $TOKEN;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        $decode=  json_decode($response, true);
        $encode = json_encode($decode);
        
    Storage::disk('public')->put("Data/Item/ItemTypes/".$type.".json", $encode, 'public');

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
        $headers[] = 'Authorization: Bearer ' . $token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);


        
        $decode=  json_decode($response, true);
        $encode = json_encode($decode);

        Storage::disk('public')->put("Data/Item/Items/".$item.".json", $encode, 'public');
        
    }

    
}
