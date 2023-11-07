<?php
/**
 * Created by PhpStorm.
 * User: Silvio Leite
 * Date: 22/08/2018
 * Time: 19:33
 */

namespace laraPWA\Services;


class MetaService
{
    public function render()
    {
        return "<?php \$config = (new \laraPWA\Services\ManifestService)->generate(); echo \$__env->make( 'laraPWA::meta' , ['config' => \$config])->render(); ?>";
    }

}