<?php

namespace Ebinf\SVKSFWahlen\Controller;

use Pagekit\Application as App;
use Ebinf\SVKSFWahlen\Model\Candidature;

/**
 * @Access(admin=true)
 */
class SVKSFWahlenController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        if (App::user()->hasAccess("svksf-wahlen: view candidatures")) {
            return App::redirect('@svksf-wahlen/candidatures');
        }
        if (App::user()->hasAccess("svksf-wahlen: settings")) {
            return App::redirect('@svksf-wahlen/settings');
        }
        if (App::user()->hasAccess("svksf-wahlen: send mails")) {
            return App::redirect('@svksf-wahlen/mails');
        }
        return App::abort(401);
    }

    /**
     * @Route("/candidatures")
     * @Access("svksf-wahlen: view candidatures")
     */
    public function candidaturesAction()
    {
        return [
        '$view' => [
          'title' => 'Kandidaturen | Wahlen',
          'name' => 'wahlen:views/admin/candidatures.php'
        ],
        '$data' => [
          'canEdit' => App::user()->hasAccess("svksf-wahlen: edit candidatures")
        ]
      ];
    }

    /**
     * @Route("/candidatures/add", name="candidatures/add")
     * @Route("/candidatures/edit/{id}", name="candidatures/edit")
     * @Access("svksf-wahlen: view candidatures")
     */
    public function editAction($id = 0)
    {
      if (!$candidature = Candidature::find($id)) {
        if ($id == 0) {
          $candidature = Candidature::create();
        } else {
          return App::abort("Kandidatur nicht gefunden", 404);
        }
      }

        return [
          '$view' => [
            'title' => 'Kandidaturen | Wahlen',
            'name' => 'wahlen:views/admin/edit.php',
          ],
          '$data' => [
            'candidature' => $candidature,
            'id' => $id,
            'editable' => App::user()->hasAccess("svksf-wahlen: edit candidatures")
          ],
        ];
    }

    /**
     * @Route("/mails")
     * @Access("svksf-wahlen: send mails")
     */
    public function mailsAction()
    {
        return [
          '$view' => [
            'title' => 'E-Mails | Wahlen',
            'name' => 'wahlen:views/admin/mails.php'
          ]
        ];
    }

    /**
     * @Route("/settings")
     * @Access("svksf-wahlen: settings")
     */
    public function settingsAction()
    {
        return [
          '$view' => [
            'title' => 'Einstellungen | Wahlen',
            'name' => 'wahlen:views/admin/settings.php'
          ]
        ];
    }
}
