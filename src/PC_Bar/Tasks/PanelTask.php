<?php

namespace PC_Bar\Tasks;

use pocketmine\Server;
use pocketmine\scheduler\PluginTask;
use PC_Bar\Main;
use pocketmine\plugin\Plugin;
###use PC_Bar\EventListener;

class PanelTask extends PluginTask{

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        parent::__construct($plugin);
    }

    public function onRun($tick){
		$this->plugin->onPanel();
    }

	public function cancel(){
      $this->getHandler()->cancel();
   }

}
