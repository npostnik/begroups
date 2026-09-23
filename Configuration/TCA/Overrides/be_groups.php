<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Npostnik\Begroups\Utility\Backend\BeGroupsLabelUtility;

$llFile = 'LLL:EXT:begroups/Resources/Private/Language/locallang_tca.xlf';
ExtensionManagementUtility::addTCAcolumns('be_groups', [
    'type' => [
        'label' => $llFile . ':be_groups.type.label',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $llFile . ':be_groups.type.item.empty', 'value' => ''],
                ['label' => $llFile . ':be_groups.type.item.group', 'value' => 'group'],
                ['label' => $llFile . ':be_groups.type.item.role', 'value' => 'role'],
                ['label' => $llFile . ':be_groups.type.item.module', 'value' => 'module'],
                ['label' => $llFile . ':be_groups.type.item.right', 'value' => 'right'],
                ['label' => $llFile . ':be_groups.type.item.treemount', 'value' => 'treemount'],
                ['label' => $llFile . ':be_groups.type.item.filemount', 'value' => 'filemount'],
                ['label' => $llFile . ':be_groups.type.item.language', 'value' => 'language'],
                ['label' => $llFile . ':be_groups.type.item.category', 'value' => 'category'],
            ],
        ],
    ],
]);

$GLOBALS['TCA']['be_groups']['types']['0']['showitem'] =
    'type'; // this means type must be set

$GLOBALS['TCA']['be_groups']['types']['group']['showitem'] =
    '--palette--;;about,
        subgroup,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['role']['showitem'] =
    '--palette--;;about,
        subgroup,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['module']['showitem'] =
    '--palette--;;about,
        groupMods, availableWidgets,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['right']['showitem'] =
    '--palette--;;about,
        mfa_providers,
        tables_select,
        tables_modify,
        pagetypes_select,
        non_exclude_fields,
        explicit_allowdeny,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['treemount']['showitem'] =
    '--palette--;;about,
        db_mountpoints,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['filemount']['showitem'] =
    '--palette--;;about,
        file_mountpoints,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['language']['showitem'] =
    '--palette--;;about,
        allowed_languages,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['types']['category']['showitem'] =
    '--palette--;;about,
        category_perms,
        tt_news_categorymounts,
     --palette--;;options';

$GLOBALS['TCA']['be_groups']['palettes']['about']['canNotCollapse'] = '1';
$GLOBALS['TCA']['be_groups']['palettes']['about']['showitem'] = 'hidden, type, title';

$GLOBALS['TCA']['be_groups']['palettes']['options']['canNotCollapse'] = '1';
$GLOBALS['TCA']['be_groups']['palettes']['options']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:be_groups.tabs.options,
        TSconfig,
        description';

// add type as "type" field for manipulation via $GLOBALS['TCA']['be_groups']['types']
$GLOBALS['TCA']['be_groups']['ctrl']['requestUpdate'] = 'type';
$GLOBALS['TCA']['be_groups']['ctrl']['type'] = 'type';
$GLOBALS['TCA']['be_groups']['ctrl']['default_sortby'] = 'ORDER BY type, title';
$GLOBALS['TCA']['be_groups']['ctrl']['label_userFunc'] =
    BeGroupsLabelUtility::class . '->getUserLabel';

// change sorting and enable filter textfield above multiselect boxes
$GLOBALS['TCA']['be_groups']['columns']['subgroup']['config']['maxitems'] = 99;
$GLOBALS['TCA']['be_groups']['columns']['subgroup']['config']['size'] = 30;
$GLOBALS['TCA']['be_groups']['columns']['subgroup']['config']['foreign_table_where'] =
    'AND NOT(be_groups.uid = ###THIS_UID###) AND NOT(be_groups.type = "group") AND be_groups.hidden=0 ORDER BY be_groups.type, be_groups.title';
