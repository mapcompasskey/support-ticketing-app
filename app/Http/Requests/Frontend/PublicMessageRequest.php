<?php namespace App\Http\Requests\Frontend;

use App\Http\Requests\PublicMessageRequest as BaseRequest;

class PublicMessageRequest extends BaseRequest {

    /**
     * The hash tag to use when redirecting with errors.
     *
     * @var string
     */
    protected $hashtag = '#errors';

}
