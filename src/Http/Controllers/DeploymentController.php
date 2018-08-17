<?php

namespace Betterde\Deployment\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

/**
 * Deployment logic controller
 *
 * Date: 2018/8/16
 * @author George
 * @package Betterde\Deployment\Http\Controllers
 */
class DeploymentController extends Controller
{
    /**
     * Hook handler
     *
     * Date: 2018/8/16
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function webhook(Request $request)
    {
        $token = $request->header('X-Gitlab-Token');
        if (config('deployment.token') && $token !== config('deployment.token')) {
            throw new AuthorizationException('The Token you provided cannot be validated');
        }

        $target = base_path();

        $enent = $request->header('X-Gitlab-Event');

        /**
         * 判断是否为推送事件
         */
        if ($enent === config('deployment.evnents.push')) {
            $ref = str_after($request->get('ref'), 'refs/heads/');
            $command = sprintf('cd %s && git pull origin %s:%s', $target, $ref, $ref);
            return shell_exec($command);
        }
    }
}
