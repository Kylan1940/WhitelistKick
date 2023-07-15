<?php

namespace Kylan1940\WhitelistKick;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use Kylan1940\WhitelistKick\UpdateNotifier\ConfigUpdater;

class Main extends PluginBase implements Listener {
  
  const PREFIX = "prefix";
	
	public function onEnable() : void {
    ConfigUpdater::update($this);
    $this->getResource("config.yml");
    $this->getServer()->getPluginManager()->registerEvents($this, $this); 
  }
  
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
    $prefix = $this->getConfig()->get(self::PREFIX);
    if($sender instanceof Player){
      if($cmd->getName() == "whitelist on"){
        if($this->getConfig("enable") == true){
          foreach ($this->getServer()->getOnlinePlayers() as $player) {
            if ($this->isWhitelisted($player)) continue;
              $player->kick($this->getConfig("kick-reason"));
          }
        } 
      }
    }
    if(!$sender instanceof Player){
      if($cmd->getName() == "whitelist on"){
        if($this->getConfig("enable") == true){
          foreach ($this->getServer()->getOnlinePlayers() as $player) {
          if ($this->isWhitelisted($player)) continue;
            $player->kick($this->getConfig("kick-reason"));
          }
        } 
      }
	  }
	}
	
}
