<?php
/**
* HomeController.php - Controller file
*
* This file is part of the Home component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Home\Controllers;

use Illuminate\Support\Str;
use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Home\HomeEngine;
use App\Yantrana\Components\Filter\FilterEngine;
use App\Yantrana\Components\Pages\ManagePagesEngine;
use App\Yantrana\Support\CommonUnsecuredPostRequest;
use App\Yantrana\Components\User\UserEncounterEngine;
use App\Yantrana\Components\UserSetting\UserSettingEngine;

class HomeController extends BaseController
{
    /**
     * @var  HomeEngine - Home Engine
     */
    protected $homeEngine;

    /**
     * @var  UserEncounterEngine - UserEncounter Engine
     */
    protected $userEncounterEngine;

    /**
     * @var  FilterEngine - Filter Engine
     */
    protected $filterEngine;

    /**
     * @var  ManagePagesEngine - Manage Pages Engine
     */
    protected $managePageEngine;

    /**
     * @var  UserSettingEngine - UserSetting Engine
     */
    protected $userSettingEngine;

    /**
     * Constructor
     *
     * @param  HomeEngine  $homeEngine - Home Engine
     * @param  ManagePagesEngine  $managePageEngine - Manage Pages Engine
     * @return  void
     *-----------------------------------------------------------------------*/
    public function __construct(
        HomeEngine $homeEngine,
        UserEncounterEngine $userEncounterEngine,
        FilterEngine $filterEngine,
        ManagePagesEngine $managePageEngine,
        UserSettingEngine $userSettingEngine
    ) {
        $this->homeEngine = $homeEngine;
        $this->userEncounterEngine = $userEncounterEngine;
        $this->filterEngine = $filterEngine;
        $this->managePageEngine = $managePageEngine;
        $this->userSettingEngine = $userSettingEngine;
    }

    /**
     * View Home Page
     *---------------------------------------------------------------- */
    public function homePage()
    {
        return $this->loadPublicView('user.home');
    }

    /**
     * ChangeLocale - It also managed from index.php.
     *---------------------------------------------------------------- */
    protected function changeLocale(CommonUnsecuredPostRequest $request, $localeId = null)
    {
        if (is_string($localeId)) {
            changeAppLocale($localeId);
            if (isLoggedIn()) {
                $this->userSettingEngine->processUserSettingStore('site_defaults', [
                    'selected_locale' => $localeId,
                ]);
            }
        }
        if ($request->has('redirectTo')) {
            $redirectUrl = base64_decode($request->get('redirectTo'));
            if($redirectUrl and Str::startsWith($redirectUrl, url(''))) {
                header("Location: $redirectUrl");
                exit();
            }
        }
        return __tr('Invalid Request');
    }

    /**
     * Change Theme
     *---------------------------------------------------------------- */
    protected function changeTheme(CommonUnsecuredPostRequest $request, $themeName = null)
    {
        if ($request->has('redirectTo')) {
            header('Location: '.base64_decode($request->get('redirectTo')));
            exit();
        }

        return __tr('Invalid Request');
    }

    /**
     * preview page
     *---------------------------------------------------------------- */
    public function previewPage($pageUid, $title)
    {
        $processReaction = $this->managePageEngine->previewPage($pageUid);

        return $this->loadView('pages.preview', $processReaction['data'], [
            'compress_page' => false,
        ]);
    }

    /**
     * preview landing page
     *---------------------------------------------------------------- */
    public function landingPage()
    {
        if(getStoreSettings('other_home_page_url') and (trim(getStoreSettings('other_home_page_url'), '/') != trim(url()->current(), '/'))) {
            return redirect()->away(getStoreSettings('other_home_page_url'));
        }
        return $this->loadView(getStoreSettings('current_home_page_view'));
    }
    

    /**
     * Search Matches
     *---------------------------------------------------------------- */
    public function searchMatches(CommonUnsecuredPostRequest $request)
    {
        $inputData = $request->all();
        // Set user search data into session
        session()->put('userSearchData', [
            'looking_for' => $inputData['looking_for'],
            'min_age' => $inputData['min_age'],
            'max_age' => $inputData['max_age'],
        ]);

        return redirect()->route('user.login');
    }
}
