<?php

namespace Ebinf\SVKSFWahlen\Controller;

use Pagekit\Application as App;
use Ebinf\SVKSFWahlen\Model\Candidature;

class SVKSFWahlenApiController
{
    /**
     * @Route("/candidatures", methods="GET")
     * @Access("svksf-wahlen: view candidatures")
     */
    public function apiGetCandidaturesAction()
    {
      return Candidature::findAll();
    }

    /**
     * @Route("/candidature/{id}", methods="GET", requirements={"id"="\d+"})
     * @Access("svksf-wahlen: view candidatures")
     */
    public function apiGetCandidatureAction($id)
    {
      if ($candidature = Candidature::find($id)) {
        return $candidature;
      }
      return App::abort(404);
    }

    /**
     * @Route("/candidature/{id}", methods="POST", requirements={"id"="\d+"})
     * @Access("svksf-wahlen: edit candidatures")
     * @Request({"candidature": "array"}, csrf=true)
     */
    public function apiSaveCandidatureAction($data, $id = 0)
    {
      if (!$candidature = Candidature::find($id)) {
        $candidature = Candidature::create();
        unset($data["id"]);
        $data["date"] = new \DateTime();
      }
      if ($candidature->status == 4 && $data["status"] != 4) {
        $data["rejection_date"] = null;
        $data["rejection_reason"] = "";
      }
      if ($candidature->status != 4 && $data["status"] == 4) {
        $data["rejection_date"] = new \DateTime();
      }
      try {
        $candidature->save($data);
      } catch (Exception $e) {
        return App::abort(400, $e->getMessage());
      }
      return ['message' => 'success', 'candidature' => $candidature];
    }
}
