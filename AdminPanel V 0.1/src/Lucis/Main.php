<?php

namespace Lucis;

use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\ModalForm;

class Main extends PluginBase {

	public function onCommand(CommandSender $komut, Command $cmd, string $label, array $args) : bool{

		if($cmd->getName() == "adminpanel"){
			$this->form($komut);
		}

		return true;
	}

	public function form(Player $player){
		$form = new SimpleForm(function(Player $player, int $data = null){
			if($data === null) return true;
			switch($data){
				case 0:
					$this->form1($player);
					break;
				case 1:
					$this->form2($player);
					break;
				case 2:
					$this->form3($player);
					break;
				case 3:
					$this->form4($player);
					break;
			}
		});
		$form->setTitle("§l§0ADMIN PANEL");
		$form->addButton("FLY", 1, "https://cdn-icons.flaticon.com/png/512/3291/premium/3291183.png?token=exp=1658837371~hmac=1fc5d17ba558b9bc50075e1fb317d5bf");
		$form->addButton("GAMEMODE", 1, "https://cdn-icons-png.flaticon.com/512/2268/2268625.png");
		$form->addButton("HEALTH", 1, "https://cdn-icons-png.flaticon.com/512/4357/4357795.png");
		$form->addButton("HUNGER", 1, "https://cdn-icons-png.flaticon.com/512/992/992710.png");
		$form->sendToPlayer($player);
		return true;
	}

	public function form1(Player $player){
			$form = new ModalForm(function(Player $player, bool $data){
				switch($data){
					case true:
						$player->setAllowFlight(true);
						$player->sendMessage("§cFlight Mode is Active");
						break;
					case false:
						$this->getServer()->getCommandMap()->dispatch($player, "gamemode 0");
						$player->setAllowFlight(false);
						$player->sendMessage("§aFlight Mode is De-Active");
						break;
				}
			});
			$form->setTitle("Fly Menu");
			$form->setContent("Use It To Activate Flight Mode");
		    $form->setButton1("Fly On");
            $form->setButton2("Fly Off");
            $form->sendToPlayer($player);
			return true;
  }

	public function form2(Player $player){
		$form = new ModalForm(function(Player $player, bool $data){
			switch($data){
				case true:
					$this->getServer()->getCommandMap()->dispatch($player, "gamemode 1");
					$player->sendMessage("§7You Are Gamemode 1");
					break;
				case false:
					$this->getServer()->getCommandMap()->dispatch($player, "gamemode 0");
					$player->sendMessage("§7You Are Gamemode 0");
					break;
			}
		});
		$form->setTitle("GAMEMODE MENU");
		$form->setContent("Use It To Activate Flight Mode");
		$form->setButton1("Gamemode 1");
		$form->setButton2("Gamemode 0");
		$form->sendToPlayer($player);
		return true;
	}

	public function form4(Player $player){
		$form = new ModalForm(function(Player $player, bool $data){
			switch($data){
				case true:
					$player->getHungerManager()->setFood(20);
					$player->sendMessage("§7Successfuly");
					break;
				case false:
					$player->sendMessage("§7Successfuly");
					break;
			}
		});
		$form->setTitle("Hunger Menu");
		$form->setContent("Use It To Feed");
		$form->setButton1("§7Okay");
		$form->setButton2("§7Exit ");
		$form->sendToPlayer($player);
		return true;
	}

	public function form3(Player $player){
		$form = new ModalForm(function(Player $player, bool $data){
			switch($data){
				case true:
					$player->setHealth(20);
					$player->sendMessage("§7Successfuly");
					break;
				case false:
					$player->sendMessage("§7Successfuly");
					break;
			}
		});
		$form->setTitle("Hearth Menu");
		$form->setContent("Use It Not To Die");
		$form->setButton1("§7Okay");
		$form->setButton2("§7Exit ");
		$form->sendToPlayer($player);
		return true;
	}
}
