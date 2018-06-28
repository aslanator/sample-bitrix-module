<?

Class test_module extends CModule
{
var $MODULE_ID = "test_module";
var $MODULE_VERSION;
var $MODULE_VERSION_DATE;
var $MODULE_NAME;
var $MODULE_DESCRIPTION;
var $MODULE_CSS;

function test_module()
{
$arModuleVersion = array();

$path = str_replace("\\", "/", __FILE__);
$path = substr($path, 0, strlen($path) - strlen("/index.php"));
include($path."/version.php");

if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
{
$this->MODULE_VERSION = $arModuleVersion["VERSION"];
$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
}

$this->MODULE_NAME = "test_module – модуль с компонентом";
$this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом test_module";
}

function InstallFiles()
{
  CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/test_module/install/components",
              $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
  return true;
}

function UnInstallFiles()
{
  DeleteDirFilesEx("/bitrix/components/dv");
  return true;
}

function DoInstall()
{
  global $DOCUMENT_ROOT, $APPLICATION;
  $this->InstallFiles();
  RegisterModule("test_module");
  $APPLICATION->IncludeAdminFile("Установка модуля test_module ", $DOCUMENT_ROOT."/bitrix/modules/test_module/install/step.php");
}

function DoUninstall()
{
  global $DOCUMENT_ROOT, $APPLICATION;
  $this->UnInstallFiles();
  UnRegisterModule("test_module");
  $APPLICATION->IncludeAdminFile("Деинсталляция модуля test_module", $DOCUMENT_ROOT."/bitrix/modules/test_module/install/unstep.php");
}
}
?>