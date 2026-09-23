<?php
namespace Npostnik\Begroups\Utility\Backend;

use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Backend\Utility\BackendUtility;

class BeGroupsLabelUtility
{
    /**
     * Get custom label including the selected "type" for backend group
     *
     * @param array $record the current content element
     * @param mixed $parentObject
     * @param mixed $params
     */
    public function getUserLabel(&$params, $parentObject): void
    {
        $typeLabel = '';

        // as $params may contain only title & uid field gain full record:
        $record = BackendUtility::getRecord($params['table'], $params['row']['uid']);
        if($record === null) {
            return;
        }
        if (array_key_exists('type', $record) && $record['type'] !== '') {
            /** @var LanguageService $languageService */
            $languageService = &$GLOBALS['LANG'];
            $typeLabel = $languageService->sL(
                'LLL:EXT:begroups/Resources/Private/Language/locallang_tca.xlf:be_groups.type.item.' . $record['type']
            );
            $typeLabel = '[' . $typeLabel . '] ';
        }
        $params['title'] = $typeLabel . $record['title'];
    }
}
