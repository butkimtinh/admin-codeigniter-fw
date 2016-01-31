<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('frmSelectBox'))
{
	function frmSelectBox($selectName, $stlData, $selectedFieldID = 0, $valueField = 'id', $titleField = 'title', $action = '')
	{
		$stlReturn = '<select class="form-control" name="'.$selectName.'" id="'.$selectName.'" '.$action.'>
			<option value="0" > -- Hãy chọn một -- </option>';
		foreach($stlData as $selectItem){
			if($selectItem[$valueField] == $selectedFieldID)
				$selectedItem = ' selected="selected" ';
			else
				$selectedItem = '';
			$stlReturn .= ' <option value="'.$selectItem[$valueField].'" '.$selectedItem.'/>'.$selectItem[$titleField];
		}
		$stlReturn .= '</select>';

		return $stlReturn;
	}
}

if ( ! function_exists('frmSelectBoxWithSearch'))
{
	function frmSelectBoxWithSearch($selectName, $stlData, $selectedFieldID = 0, $valueField = 'id', $titleField = 'title', $action = '')
	{
		//Select Form Data
		$groupTitle = '';
		$selectedItem = '';
		$stlReturn = '
			<select id="'.$selectName.'" name="'.$selectName.'" style="width:100%" class="populate">
				<option value="0" > -- Hãy chọn một -- </option>';

		foreach($stlData as $selectItem){
			//Data
			if($selectItem[$valueField] == $selectedFieldID)
				$selectedItem = ' selected="selected" ';
			else
				$selectedItem = '';

			$stlReturn .= '<option value="'.$selectItem[$valueField].'" '.$selectedItem.'>'.$selectItem[$titleField].'</option>';
		}
		$stlReturn .= '
			</select>';
			
		//Script and Stype 
		$stlReturn .= '
			<script type="text/javascript" src="'.base_url().'/public/avant/assets/plugins/form-select2/select2.min.js"></script> 
			<link rel="stylesheet" type="text/css" href="'.base_url().'/public/avant/assets/plugins/form-select2/select2.css" /> 
			<script>
				$(function() {
					var opts=$("#'.$selectName.'").html(), opts2="<option></option>"+opts;
					$("#'.$selectName.'").each(function() { var e=$(this); e.html(e.hasClass("placeholder")?opts2:opts); });
			
			
					$("#'.$selectName.'").select2({width: "resolve"});
				});
			</script>';

		return $stlReturn;
	}
}

if ( ! function_exists('frmSelectGroupBox'))
{
	function frmSelectGroupBox($selectName, $stlData, $selectedFieldID = 0, $groupField = 'category_name', $valueField = 'id', $titleField = 'title', $action = '')
	{
		$groupTitle = '';
		$stlReturn = '<select class="form-control" name="'.$selectName.'" id="'.$selectName.'" '.$action.'>
						<option value="0" > -- Hãy chọn một -- </option>';

		foreach($stlData as $selectItem){

			//Group Field
			if($selectItem[$groupField] != $groupTitle){
				if($groupTitle != "")
					$stlReturn .= '</optgroup>';
				$groupTitle = $selectItem[$groupField];
				$stlReturn .= '<optgroup label="'.$groupTitle.'">';
			}
			if($selectItem[$valueField] == $selectedFieldID)
				$selectedItem = ' selected="selected" ';
			else
				$selectedItem = '';
			$stlReturn .= ' <option value="'.$selectItem[$valueField].'" '.$selectedItem.'/>'.$selectItem[$titleField];
		}
		$stlReturn .= '</select>';

		return $stlReturn;
	}
}

if ( ! function_exists('frmSelectGroupBoxWithSearch'))
{
	function frmSelectGroupBoxWithSearch($selectName, $sltData, $selectedFieldID = 0, $groupField = 'category_name', $valueField = 'id', $titleField = 'title', $action = '')
	{
		//Select Form Data
		$groupTitle = '';
		$stlReturn = '
			<select id="'.$selectName.'" name="'.$selectName.'" style="width:100%" class="populate">
				<option value="0" > -- Hãy chọn một -- </option>';
		foreach($sltData as $selectItem){
			//Group Field
			if($selectItem[$groupField] != $groupTitle){
				if($groupTitle != "")
					$stlReturn .= '</optgroup>';
				$groupTitle = $selectItem[$groupField];
				$stlReturn .= '<optgroup label="'.$groupTitle.'">';
			}
			//Data
			if($selectItem[$valueField] == $selectedFieldID)
				$selectedItem = ' selected="selected" ';
			else
				$selectedItem = '';

			$stlReturn .= '<option value="'.$selectItem[$valueField].'" '.$selectedItem.'>'.$selectItem[$titleField].'</option>';
		}
		$stlReturn .= '
			</select>';
			
		//Script and Stype 
		$stlReturn .= '
			<script type="text/javascript" src="'.base_url().'/public/avant/assets/plugins/form-select2/select2.min.js"></script>
			<link rel="stylesheet" type="text/css" href="'.base_url().'/public/avant/assets/plugins/form-select2/select2.css" />
			<script>
				$(function() {
					var opts=$("#'.$selectName.'").html(), opts2="<option></option>"+opts;
					$("#'.$selectName.'").each(function() { var e=$(this); e.html(e.hasClass("placeholder")?opts2:opts); });
			
			
					$("#'.$selectName.'").select2({width: "resolve"});
				});
			</script>';

		return $stlReturn;
	}
}

if ( ! function_exists('frmStatusSelector'))
{
	function frmStatusSelector($chkName, $stlData, $selectedFieldID = array(), $valueField = 'value', $titleField = 'title', $action = '')
	{

		$strReturn = '';
		foreach($stlData as $selectItem){
			if(in_array($selectItem[$valueField], $selectedFieldID))
				$strChecked = 'checked="checked"';
			else
				$strChecked = '';
			$strReturn .= '<div class="col-sm-4">
				<label class="checkbox-inline">
				  <input type="checkbox" id="'.$chkName.'[]" name="'.$chkName.'[]" value="'.$selectItem[$valueField].'" '.$strChecked.' />
				  <span>'.$selectItem[$titleField].'</span>
				</label></div>';
		}
		$strReturn .= '<div class="col-sm-4">
				<label class="checkbox-inline">
				  <input type="checkbox" id="chkCheckAll" />
				  Chọn/Bỏ chọn Tất cả
				</label></div>';

		return $strReturn;
	}
}

if ( ! function_exists('sltMultiSelect'))
{
    function sltMultiSelect($sltName, $stlData, $selectedFieldID = array(), $valueField = 'value', $titleField = 'title', $action = '')
    {

        $strReturn = ' <select id="'.$sltName.'" class="multiselect" multiple="multiple" name="'.$sltName.'[]">';
        if(count($selectedFieldID)){
            foreach ($selectedFieldID as $slted)
                $strReturn .= '<option value="'.$stlData[$slted][$valueField].'" selected="selected" >'.$stlData[$slted][$titleField].'</option>';
        }

        foreach($stlData as $selectItem){
            if(!in_array($selectItem['id'], $selectedFieldID))
                $strReturn .= '<option value="'.$selectItem[$valueField].'" >'.$selectItem[$titleField].'</option>';
        }

        $strReturn .= '</select>';

        $strReturn .= '<script>

        ';
        $strReturn .= '</script>';
        return $strReturn;
    }
}




if ( ! function_exists('sltModulesRole'))
{
    function sltModulesRole($sltName, $selectedModules = array(), $action = '')
    {
        $modulesList = scandir('application/modules');
        if(($selectedModules != '') && ($selectedModules != null))
            $arrSelectedModules = explode(',', $selectedModules);
        else
            $arrSelectedModules = array();
            $strReturn = '<select multiple="multiple" id="'.$sltName.'" name="'.$sltName.'">';
        foreach($modulesList as $module){
            if(($module != '.') && ($module != '..')){
                if(in_array($module, $arrSelectedModules))
                    $strSelected = 'selected="selected"';
                else
                    $strSelected = '';
                $strReturn .= '<option '.$strSelected.' />'.$module;
            }

        }
        $strReturn .= '</select>';
        return $strReturn;
    }
}


// ------------------------------------------------------------------------
