<?php

namespace Fqstalph;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandExecutor;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;


class Main extends PluginBase implements Listener {

   public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->saveDefaultConfig();
   }

   public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args) : bool{
      switch($cmd->getName()) {
               case "ss":
                 if($sender->hasPermission("ss.cmd")) {
                  if($sender instanceof Player) {
                   $target = $this->getServer()->getPlayer($args[0]);
                   $target->sendTitle("§4You're under", "§4screenshare.", 300, 100);
                   $sender->teleport($this->getServer()->getLevelByName($this->getConfig()->get('World'))->getSpawnLocation());
                   $target->teleport($sender);
                   $target->setImmobile(true);
                   $message = str_replace("{player}", $target->getDisplayName(), $this->getConfig()->get("Message"));
                   $this->getServer()->broadcastMessage($message);
                 } else {
                   $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
                 }
               } else {
                 $sender->sendMessage("§cYou don't have enough permission!");
               }
			   break;
			   case "ok":
			      if($sender->hasPermission("ss.cmd")) {
                  if($sender instanceof Player) {
                   $target = $this->getServer()->getPlayer($args[0]);
                   $target->setImmobile(false);
                 } else {
                   $sender->sendMessage("§cPuoi eseguire questo comando solo in-game!");
                 }
				  } else {
            $sender->sendMessage("§cYou don't have enough permission!");
          }
           return true;
       }
       return false;
     }
}
