<?php

declare(strict_types=1);

namespace foxdev\AntiVoid;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerMove(PlayerMoveEvent $event): void {
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $y = $player->getPosition()->getY();

        $config = $this->getConfig();
        $voidY = $config->get($worldName);

        if ($voidY !== null && is_numeric($voidY) && $y < (int)$voidY) {
            $spawn = $world->getSpawnLocation();
            $player->teleport($spawn);
        }
    }
}
