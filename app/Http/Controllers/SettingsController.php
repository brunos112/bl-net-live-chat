<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiOperationFailedException;
use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\SettingsRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

/**
 * Class SettingsController
 */
class SettingsController extends AppBaseController
{
    /**
     * @var SettingsRepository
     */
    private $settingsRepository;

    /**
     * SettingsController constructor.
     * 
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $settings = $this->settingsRepository->getSettings();

        $enabledGroupChat = 'checked';
        $membersCanAddGroup = 'checked';
        if (isset($settings['enable_group_chat'])) {
            $enabledGroupChat = ($settings['enable_group_chat'] == 1) ? 'checked' : '';
        }
        if (isset($settings['members_can_add_group'])) {
            $membersCanAddGroup = ($settings['members_can_add_group'] == 1) ? 'checked' : '';
        }

        return view('settings.index', compact('settings', 'enabledGroupChat', 'membersCanAddGroup'));
    }

    /**
     * @param UpdateSettingRequest $request
     *
     * @throws ApiOperationFailedException
     *
     * @return Factory|View
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingsRepository->updateSettings($request->all());
        $settings = $this->settingsRepository->getSettings();
        $enabledGroupChat = ($settings['enable_group_chat'] == 1) ? 'checked' : '';
        $membersCanAddGroup = ($settings['members_can_add_group'] == 1) ? 'checked' : '';
        Flash::success('Settings updated successfully.');
        
        return view('settings.index', compact('settings', 'enabledGroupChat', 'membersCanAddGroup'));
    }
}
