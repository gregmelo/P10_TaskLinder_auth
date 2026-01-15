<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AppExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\HttpFoundation\RequestStack;

class AppExtension extends AbstractExtension
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFunctions(): array
    {
        return [
            // Déclare la nouvelle fonction Twig que nous allons utiliser : is_active_route('projet')
            new TwigFunction('is_active_route', [$this, 'isActiveRoute']),
        ];
    }

    /**
     * Vérifie si la route courante commence par le préfixe du module spécifié.
     * @param string|array $modulePrefix Le préfixe de la route (ex: 'projet' ou ['home', 'projet', 'tache'])
     * @return bool
     */
    public function isActiveRoute($modulePrefix): bool
    {
        // Récupère le nom de la route actuelle
        $currentRoute = $this->requestStack->getCurrentRequest()
        ? $this->requestStack->getCurrentRequest()->attributes->get('_route')
        : null;

        if (!$currentRoute) {
            return false;
        }

        // Si l'utilisateur passe un seul préfixe (string)
        if (is_string($modulePrefix)) {
             // Exemple: 'app_projet' commence par 'app_projet'
            return str_starts_with($currentRoute, 'app_' . $modulePrefix);
        }

        // Si l'utilisateur passe un tableau de préfixes (pour gérer 'app_home' et 'app_projet' ensemble)
        if (is_array($modulePrefix)) {
            foreach ($modulePrefix as $prefix) {
                // Si le préfixe est 'home', on vérifie la route exacte 'app_home'
                if ($prefix === 'home' && $currentRoute === 'app_home') {
                    return true;
                }
                // Si c'est un module, on vérifie si la route commence par 'app_module'
                if ($prefix !== 'home' && str_starts_with($currentRoute, 'app_' . $prefix)) {
                    return true;
                }
            }
        }

        return false;
    }
}
