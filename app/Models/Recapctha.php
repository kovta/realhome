<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Recapctha extends Model
{
    use HasFactory;

    /**
     * Recaptcha token
     *
     * @var string
     */
    private string $token;

    /**
     * @var string
     */
    public string $recapctchaResponse;

    /**
     * @var array|string[]
     */
    private array $recaptchaResponseValues = array(
        'missing-input-secret' => 'The secret parameter is missing.',
        'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
        'missing-input-response' => 'The response parameter is missing.',
        'invalid-input-response' => 'The response parameter is invalid or malformed.',
        'bad-request' => 'The request is invalid or malformed.',
        'timeout-or-duplicate' => 'The response is no longer valid: either is too old or has been used previously.',
        );

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $response = Http::post(env('RECAPTCHA_API_VALIDATION_URL'), [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $this->token
        ])->json();
        if($response['success']) {
            return true;
        }
        $this->recapctchaResponse = array_search($response['error-codes'][0], $this->recaptchaResponseValues, true);
        return false;
    }
}
