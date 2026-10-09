<?php
/**
 * IcebreakerController.php - Public controller
 *
 * This file is part of the Icebreaker component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Controllers;

use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Icebreaker\IcebreakerEngine;
use Illuminate\Http\Request;

class IcebreakerController extends BaseController
{
    /**
     * @var IcebreakerEngine - Icebreaker Engine
     */
    protected $icebreakerEngine;

    /**
     * Constructor.
     *-----------------------------------------------------------------------*/
    public function __construct(IcebreakerEngine $icebreakerEngine)
    {
        $this->icebreakerEngine = $icebreakerEngine;
    }

    /**
     * GET /icebreakers — deck selection view.
     * Supports ?category= filter via query string (all | dating | couples | friends).
     *---------------------------------------------------------------- */
    public function index(Request $request)
    {
        $category = $request->query('category');

        $processReaction = $this->icebreakerEngine->preparePublicIndex($category);

        return $this->loadView('icebreakers.index', $processReaction['data']);
    }

    /**
     * GET /icebreakers/{slug} — deck detail with "Start Playing" button.
     *---------------------------------------------------------------- */
    public function show($slug)
    {
        $processReaction = $this->icebreakerEngine->prepareDeckDetail($slug);

        if ($processReaction['reaction_code'] !== 1) {
            return redirect()
                ->route('icebreakers.index')
                ->with('error', $processReaction['data']['message']);
        }

        return $this->loadView('icebreakers.show', $processReaction['data']);
    }

    /**
     * GET /icebreakers/{slug}/play — the two-card play view.
     *---------------------------------------------------------------- */
    public function play($slug)
    {
        $processReaction = $this->icebreakerEngine->preparePlay($slug);

        if ($processReaction['reaction_code'] !== 1) {
            return redirect()
                ->route('icebreakers.index')
                ->with('error', $processReaction['data']['message']);
        }

        return $this->loadView('icebreakers.play', $processReaction['data']);
    }
}
