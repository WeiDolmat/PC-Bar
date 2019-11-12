<?php

namespace PC_Bar;

use PC_Bar\Tasks\PanelTask;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener {

 	
 
 	public function onEnable() {
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->EconomyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
      $this->getServer()->getScheduler()->scheduleRepeatingTask(new PanelTask($this), 10);
		$this->getLogger()->info("§aPC_Bar - включён.");
      @mkdir($this->getDataFolder());
      $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array("Название сервера" => "server"));
      @mkdir($this->getDataFolder());
      $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array("Валюта" => "₽"));
      @mkdir($this->getDataFolder());
      $this->config = new Config ($this->getDataFolder() . "config.yml" , Config::YAML, array("Сайт/Группа сервера" => "site/group"));
          $this->saveResource("config.yml");


 	}
 	
	public function onPanel() {
        foreach($this->getServer()->getOnlinePlayers() as $p) {
			   $player = $p->getPlayer()->getName();
            $online = count(Server::getInstance()->getOnlinePlayers());
            $max = $this->getServer()->getMaxPlayers(); 
		      $money = $this->EconomyAPI->mymoney($player);
		      $date = date("H:i.s");
		      $date1 = date("d.m.y");
			   $t = str_repeat(" ", 75);
           $p->sendTip($t. "§r".$this->config->get("Название сервера")."§f§r\n" .$t. "§e§lВаш ник§r§f: ". $player."§r\n" .$t. "§6§lОнлайн§r§f: ". $online."/".$max."§r\n" .$t. "§e§lБаланс§r§f: ".$money."" .$this->config->get("Валюта"). " §r\n" .$t. "§a§lВремя§f:§f " . $date."§r\n" .$t. "§b§lДата§f:§f " . $date1."§r\n" .$t. "§r".$this->config->get("Сайт/Группа сервера")."§f§r".str_repeat("\n", 0));
			
		}
    }

	public function onDisable() {
		$this->getLogger()->info("§cPC_Bar - выключен.");
	}
}
