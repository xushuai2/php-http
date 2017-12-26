<?php
		header("Content-Type: text/html; charset=utf-8");
		/** 
		* 远程签接口测试
		* @author      xushuai
		*/  
		require_once(dirname(__FILE__).'/'.'../com.qiyuesuo.service.impl/RemoteSignServiceImpl.php');
		require_once(dirname(__FILE__).'/'.'../com.qiyuesuo.common/Util.php');

		$remoteSignServiceImpl = new RemoteSignServiceImpl(Util::getSDk());
		
		//***********************************************************************1.1 由本地PDF文件创建
/*		$a1 = get_millistime();
		
		$file_name = "D:/fenge.pdf";
		
	    $subject = "ceshi";//合同主题
	    $expireTime = "2018-07-08";//合同过期时间(大于当前时间)；过期未结束签署，则作废，不传该参数则默认30天后过期。
	    $docName = "languageRemote";//合同文件名称
		$file = new \CURLFile(realpath($file_name));//合同文件
		
		$contract = new Contract();
		$contract->set_subject($subject);
		$contract->set_docName($docName);
		$contract->set_expireTime($expireTime);
		$contract->set_file($file);
		
		$result =  $remoteSignServiceImpl->createByLocal($contract);
		$a2 = get_millistime();
		$a3 = $a2-$a1;
		print_r($result);
		print_r("**************耗时：".$a3);*/
		
		/*		Array
		(
		    [code] => 0
		    [documentId] => 2310300463639077504
		    [message] => SUCCESS
		)
		*/
		
		
		
		
		
		//***********************************************************************1.2 由模版创建
		$templates = array(
			'nameA'=>110,
		    'locationA'=>'毛泽东3'
		);
		
		//校验模板参数的类型标识
		$flag = true;
		
		foreach($templates as $key => $value){
			if(!is_string($value)){
				$flag = false;
				break;
			}
		}
		
		if($flag){
			$subject = "php-remote";//合同主题
		    $expireTime = "2018-07-08";//合同过期时间；过期未结束签署，则作废，不传该参数则默认30天后过期。
			$templateId = "2368321310162387313";//合同模板ID；合同模板在契约锁云平台维护，请到契约锁云平台查看模板ID
		    $docName = "王府井";//合同文件名称
			$templateParams = json_encode($templates);//合同模版参数，键值对形式字符串
			
			$contract = new Contract();
			$contract->set_subject($subject);
			$contract->set_expireTime($expireTime);
			$contract->set_templateId($templateId);
			$contract->set_docName($docName);
			$contract->set_templateParams($templateParams);
			
			$result = $remoteSignServiceImpl->createByTemplate($contract);
			print_r($result);
		}else{
			print_r("模板参数的值需要是字符串");
			throw new Exception('模板参数$templates的值需要是字符串'); 
		}
	    
		
		
		
		//***********************************************************************1.3 由html创建
		$contract = new Contract();
		$contract->set_subject("222remote-PHP-Html");//合同主题
		$contract->set_expireTime("2017-07-08");//合同过期时间；过期未结束签署，则作废，不传该参数则默认30天后过期。
		$contract->set_docName("222remotehtmlphplanguage2");//合同文件名称
		$contract->set_html("<html><body><p>title</p><p>xushuai在线第三方电子合同平台。企业及个人用户可通过本平台与签约方快速完成合同签署，安全、合法、有效。</p></body></html>");//html格式的合同
		//$result = $remoteSignServiceImpl->createByHtml($contract);
		//print_r($result);
		
		
		
		//***********************************************************************2.1 运营方签署
		/* 
		 * 2.1.1指定坐标位置签署
		 * --------------------------------------------------------------
		 * 平台签署,带签名外观
		 * --------------------------------------------------------------
		 */
		 
		 $acrossPagePosition = 0.25;//启用骑缝章 并指定位置  骑缝章纵坐标百分比（取值范围：大于0 小于1）
		 //$acrossPagePosition = null;//不启用骑缝章
		 
		 $stamper = new Stamper();
		 $stamper->set_page(1);
		 $stamper->set_offsetX(0.2);
		 $stamper->set_offsetY(0.4);
		 $stamper->set_acrossPagePosition($acrossPagePosition);
		 
		 $documentId = "2357365074627539020";
		 $sealId = "2350914083093758134";//印章在契约锁的唯一标识*/
 
		 //$result =  $remoteSignServiceImpl->signByPlatform($documentId,$sealId,$stamper);
		 //print_r($result);
        
		
		
		/* 2.1.2关键字签署：
		 * --------------------------------------------------------------
		 * 平台签署,带签名外观
		 * --------------------------------------------------------------
		 */
		$acrossPagePosition = null;//不启用骑缝章
		//$acrossPagePosition = 0.25;//启用骑缝章 并指定位置  骑缝章纵坐标百分比（取值范围：大于0 小于1）
		
		$stamper = new Stamper();
        $stamper->set_offsetX(0.1);
        $stamper->set_offsetY(-0.2);
        $stamper->set_keyword("市");
        $stamper->set_keywordIndex(1);
        $stamper->set_acrossPagePosition($acrossPagePosition);//骑缝章
        
        $documentId = "2320415815479464937";
        $sealId = "2307419306108956847";//印章在契约锁的唯一标识
		
		//$result =  $remoteSignServiceImpl->signByPlatform($documentId,$sealId,$stamper);
		//print_r($result);
		
		 /* 2.1.3
         * --------------------------------------------------------------
		 * 平台签署,不带签名外观
		 * --------------------------------------------------------------
		 */
        $documentId = "2319467340736213123";
        //$result =  $remoteSignServiceImpl->signByPlatNoVisible($documentId);
		//print_r($result);
		
		
		
		
		//***********************************************************************2.2 企业用户签署
		/* 2.2.1指定坐标位置签署
		 * --------------------------------------------------------------
		 * 企业用户签署,带签名外观
		 * --------------------------------------------------------------
		 */
        
        
        $acrossPagePosition = 0.75;//启用骑缝章 并指定位置  骑缝章纵坐标百分比（取值范围：大于0 小于1）
        //$acrossPagePosition = null;//不启用骑缝章
		
		$sealImageBase64 = "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";
		$documentId = "2358586271409319958";
		
		$company = new Company();
		$company->name = '上海信息科技股份有限公司';
		$company->telephone = '45782136589';
		
		$stamper = new Stamper();
        $stamper->set_page(1);
        $stamper->set_offsetX(0.4);
        $stamper->set_offsetY(0.3);
        $stamper->set_acrossPagePosition($acrossPagePosition);//骑缝章
		
        
		//$result =  $remoteSignServiceImpl->signBycompany($documentId,$company,$sealImageBase64,$stamper);
		//print_r($result);
		
		
		
		/* 2.2.2关键字签署：
		 * --------------------------------------------------------------
		 * 企业用户签署,带签名外观
		 * --------------------------------------------------------------
		 */
		
		
		$acrossPagePosition = 0.75;//启用骑缝章 并指定位置  骑缝章纵坐标百分比（取值范围：大于0 小于1）
        //$acrossPagePosition = null;//不启用骑缝章
		
		$company = new Company();
		$company->name = '上海信息科技股份有限公司';
		$company->telephone = '45782136589';
		
		$stamper = new Stamper();
        $stamper->set_offsetX(0.02);
        $stamper->set_offsetY(0.02);
		$stamper->set_keyword("市");//关键字；用来确定印章的坐标位置
		$stamper->set_keywordIndex(1);//关键字索引，默认为1；取值范围：1到无穷大/-1到无穷小 ；1代表第一个；-1代表最后一个
		$stamper->set_acrossPagePosition($acrossPagePosition);//骑缝章

		$sealImageBase64 = "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";
		$documentId = "2319467340736213123";
        
		//$result =  $remoteSignServiceImpl->signBycompany($documentId,$company,$sealImageBase64,$stamper);
		//print_r($result);
		
		
		/* 2.2.3
         * --------------------------------------------------------------
		 * 企业用户签署,不带签名外观
		 * --------------------------------------------------------------
		 */
        $documentId = "2319467340736213123";
        $company = new Company();
		$company->name = '上海信息科技股份有限公司';
		$company->telephone = '45782136589';
        //$result =  $remoteSignServiceImpl->signBycompanyNoVisible($documentId,$company);
		//print_r($result);
		
		
		//***********************************************************************2.3 个人用户签署
		/* 指定坐标位置签署
		 * --------------------------------------------------------------
		 * 个人用户签署,带签名外观
		 * --------------------------------------------------------------
		 */
		$documentId = "2320452915138532000";
		$person = new Person();
		$person->name='丁武';
		$person->mobile='45782136589';
		$person->gender='MALE';
		
		$stamper = new Stamper();
        $stamper->set_page(1);
        $stamper->set_offsetX(0.9);
        $stamper->set_offsetY(0.6);
		
		$sealImageBase64 = "iVBORw0KGgoAAAANSUhEUgAAALQAAABkCAYAAAAv8xodAAABh0lEQVR42u3dUW7CQAxF0ex/02EBgFDETGI/nyPxVxXVvkwAFXEcAAAAAAAAAAAAAAAAAAAAAAAAAMBO548b73OiSbzCvjYnGoQ7bYHmEhxs8vLMZGiwXRdoFmJtszwPZEGau5n1iNnVzfxav4NgKdfn/+1nWRz2yvvB7G4bmsUIGou59SrKgCuBgwBBCxpBi9mCLEfQgjYvMxO0eWFB5oUFmZcFWZBZWZJZYUnzZuWdEUG3n5X/pRZ06zn5gICg28/Jp4YELVxRC7pLsCvuF0E/EvWO+0XQW6NePSMxP7TcqX/77ge9mAUddQUTtKBjghazoAWNoKvORtCCjn/+jKAFjWFXeKCbsaCdznixImiLM3BPNwTtdPaiW9CCFrSgPd1A0E5nCzT4ikH7UICgS52on36fzyIKuuzp7ItRb1rMv5czQfuq6VYnzeRL2DngZnEhwzjdsg+k1GGIZ/BroNRHt9PNuxlxCxWuqCOXLFxRWz7ZUYOgoWLUEBM0AAAAAAAAAABQyAu58uZgb5mSegAAAABJRU5ErkJggg==";
		
		
		//$result =  $remoteSignServiceImpl->signByPerson($documentId,$person,$sealImageBase64,$stamper);
		//print_r($result);
		
		/* 关键字签署：
		 * 有了keyword，就不需要page
		 * --------------------------------------------------------------
		 * 个人用户签署  带签名外观
		 * --------------------------------------------------------------
		 */
		$person = new Person();
		$person->name='丁武';
		$person->mobile='45782136589';
		
		$sealImageBase64 = "iVBORw0KGgoAAAANSUhEUgAAALQAAABkCAYAAAAv8xodAAABh0lEQVR42u3dUW7CQAxF0ex/02EBgFDETGI/nyPxVxXVvkwAFXEcAAAAAAAAAAAAAAAAAAAAAAAAAMBO548b73OiSbzCvjYnGoQ7bYHmEhxs8vLMZGiwXRdoFmJtszwPZEGau5n1iNnVzfxav4NgKdfn/+1nWRz2yvvB7G4bmsUIGou59SrKgCuBgwBBCxpBi9mCLEfQgjYvMxO0eWFB5oUFmZcFWZBZWZJZYUnzZuWdEUG3n5X/pRZ06zn5gICg28/Jp4YELVxRC7pLsCvuF0E/EvWO+0XQW6NePSMxP7TcqX/77ge9mAUddQUTtKBjghazoAWNoKvORtCCjn/+jKAFjWFXeKCbsaCdznixImiLM3BPNwTtdPaiW9CCFrSgPd1A0E5nCzT4ikH7UICgS52on36fzyIKuuzp7ItRb1rMv5czQfuq6VYnzeRL2DngZnEhwzjdsg+k1GGIZ/BroNRHt9PNuxlxCxWuqCOXLFxRWz7ZUYOgoWLUEBM0AAAAAAAAAABQyAu58uZgb5mSegAAAABJRU5ErkJggg==";
		
		$documentId = "2320107957334221365";
		
		$stamper = new Stamper();
        $stamper->set_offsetX(0.01);
        $stamper->set_offsetY(-0.03);
		$stamper->set_keyword("市");//关键字；用来确定印章的坐标位置
		$stamper->set_keywordIndex(1);//关键字索引，默认为1；取值范围：1到无穷大/-1到无穷小 ；1代表第一个；-1代表最后一个
		
		//$result =  $remoteSignServiceImpl->signByPerson($documentId,$person,$sealImageBase64,$stamper);
		//print_r($result);
		
		/* 2.3.3
         * --------------------------------------------------------------
		 * 个人用户签署 ,不带签名外观
		 * --------------------------------------------------------------
		 */
		$documentId = "2320107957334221365";
        $person = new Person();
		$person->name='徐帅dshuai';
		$person->mobile='177170889888';
		
        //$result =  $remoteSignServiceImpl->signByPersonNoVisible($documentId,$person);
		//print_r($result);
		
		
		//***********************************************************************3.1 完成签署
		$documentId = "2357364147963179073";
		//$result = $remoteSignServiceImpl->complete($documentId);
		//print_r($result);
		
		//***********************************************************************4.1 查询合同详情
		//入参：String     documentId:合同文件的唯一标识
		$documentId = "2319467340736213123";
		//$result = $remoteSignServiceImpl->detail($documentId);
		//print_r($result);
		
		
		
		//***********************************************************************5.1 下载合同清单
		//入参：String     documentId:合同文件的唯一标识
		//$result = $remoteSignServiceImpl->downloadZip('2307469147923706171');
		//print_r($result);
		
		
		//***********************************************************************5.2 下载单个合同文件
		//入参：String     documentId:合同文件的唯一标识
		//$result =  $remoteSignServiceImpl->downloadPdf('2307469147923706171');
		//print_r($result);
		
		//***********************************************************************6.1 获取签署页面链接
		//---------6.1.1 COMPANY（公司）签署页面链接   请求示例：
		
		$acrossPagePosition = 0.55;//启用骑缝章 并指定位置  骑缝章纵坐标百分比（取值范围：大于0 小于1）
        //$acrossPagePosition = null;//不启用骑缝章
		
		$company = new Company();
		$company->name = '上海信息科技股份有限公司';
		$company->registerNo = '1114447778547';
		
		$stamper = new Stamper();
        $stamper->set_page(1);
        $stamper->set_offsetX(0.2);
        $stamper->set_offsetY(0.1);
        $stamper->set_acrossPagePosition($acrossPagePosition);//骑缝章
        
        $documentId = "2358586271409319958";
        
        $sealImageBase64 = "iVBORw0KGgoAAAANSUhEUgAAAKoAAACqCAYAAAA9dtSCAAAgAElEQVR4nO29ebQV1Zn//dm8LBaL5kfzIzShCCGGoEEkxhAFhzgkzgMqTqVRQ9TQaowxhhBDjHEZY4gxtjFGiVETcS6H4DzjgBMaJRqJU4ghtk3ZNE2zaJqXdZv37veP71P31KlTdU6dc8+9F5DvWmfde6vq7Nq36tnPfuYHtmALNgG4vp7A5gYfBgOAfkCHi+LOvp7P5oIthFoHRnTjgK2AMcDH7edwYBgw1H4OAgYA/TNDdAIdwHpgNbAq9fN94O/2cxnwjoviNT35/2zK2EKoBh8GI4CdgSnABPuMpZb4ehLLgTfs8wdgkYvipb14/40WH1pC9WEwBtgH2BcR6FZ9OqFirAIWAU8Cj7oo/lMfz6dP8KEhVB8G/YA9gCOBA9CWviliBfA4cBfwoIvi9X08n17BZk+oPgz2Ao4HDkey5eaEdcDDQATc7aK4o4/n02PYLAnVh8FWwFeAk2jPlt6J5Mf37LMC+E+0La9CylJH6tOfinI1ACldQ4GPIOVrNFLKxgBD2jA/bB63Ade5KF7cpjE3GmxWhGrccyZwEDIRtYJ3gZeA16koNkt7ytTkw2AIFeVtO2B7YDLdI+CXgEuBOzcXE9kmT6gme34ZmIVecjPoBF4FHgWeQ1r2yvbOsDX4MJiAlLwvIqVvZAvDvAdcDvzaRfG6Nk6v17HJEmqKQM+nOcVoDfAgMB943EXxqh6YXtvhw2AiUgKPRBy3mR1jBXAJ8KtNVfnaJAnVh8ERwBxgm5JfWQfcjZSOhzd1pcOHwSjgKKQkTm7iqyuAC4GrNjWRYJMiVB8Gk4DLkJmpDBYD1wC3bK5eHxMRZgAnUN6q8QYw00Xxwz02sTZjkyBUHwZD0dZ1Mo23vA3AvcAlLooXteHeWwHnAad3hxP7MBjqonh1d+dTZ/wByNJxNlLMyuBB9H+911Pzahda1Yx7DT4MjgHeBr5G/fl2AFcBW7soPrJZIvVhsKsPgy9kj7soXoaUmi83M15m7P6IiJK/h6Z+H93quGm4KO5wUXyti+LtgAOB50t87SDgzz4MvmUy/0aLjXZyPgxG+jB4AMmVI+pcugG4FviUi+IzjLBawcvArSb/ZfEosoO2iuHAYT4M9vFhcBrwpm3ZUE3AX/BhUFbuLoSL4oddFO+GCPalBpcPRuLUi6k5bXTYKAnVh8HhyI55UINL7wU+7aJ4hovi97tzT9vWFwE75Jx+BfhEN4YfA4wHTgd2QdFWH9i5KT4MnvZh8BzwNDJFtQVGsFOQpWBZg8t3BF7xYfD1dt2/ndioCNWHwSAfBtcg01E9xWAJsLeL4sNcFL/bxik8Q76p608Fx8tiLHC5i+IjgbOAJ1JmseHAGUghehf4TTfukwsXxb8HPg2cC6ytc+lA4EofBg/4MNio3M0bDaH6MBgHvIhk0SKsB2YDn3VR/EQPTGMReqFZvEXKFObD4AgfBi82sU2PRYsLRPDv2DhDgLUuipcgF+gHLoo3tDr5ejAZ9ifAtig+oB4OAl7zYbBzT8ylFWwUhOrD4FAUfzmxzmULgc+4KP5pD9oAczmniQUbfBgc7sNgAXARcDVQNlZ0a4w4EdH+xX7fEZnQIEXAraJAvq6Ci+L3XRQfiGyw9bxwo4CnTabuc/RmUHAufBhcAPyA4kXTAcx2UfwvJce7GHgNuK1ZgnZRvN6HwcDMeAOBf0YuzJnARS3YH8dQkRHHIc4NsCsSc0AE/FqT46bnOQS4EphW5noXxbf4MHgcmIc8XnkYAMz1YbATcGpPcfsy6DNCNbvf76hv9nkLOM5F8atNDD0XiRCdKJqoWSz1YXAAkhmHIM/Pg0hxe6VFI/k44O8+DJag1JOb7PhnXRT/2H4fgSwPreJS6sufNXBRvAI40IfBt5Gnb0DBpScDW/kwmNZXjpM+2frNjvgY9Yn0FuDzTRJpYvecgRSUZuc1BnG2m5FiNQ1ZFY4D7gA+b9dtZQutzJgDkSdoaxfF+yPu+r6JO/NTl3agEMCm4cPgm0iuvDrnXEM503arKdS3DHwJeMGeUa+j1wnV5KgXKHaDbgDOdlF8fKOIHx8GA3wYHGoG9S64KL4XeM+cBWXmNMmHwV3IPPQuigf4hYvitS6KEzPSW8AkI7y70G5QBuOBxan/pb999ndRfEvquseBeT4MXjdFrdS7MXPSdLSon7Vj37afA8gh3jwYQ/i8zaMIE5C9tZ4u0SPoVUI1d+Rz6OXlYSUyO/2i5JD9gXuA/Wz8I3wYHODDYDCSJ8/PypwFWAY8gDT+04FJNt72JvuBDOMTkVgxCil/ZTAe2YQTwlkHHIKsF11wUfwGsDfaDU4qI1+bfB8CeyYLyofByRjnR5aKt0rOEzOZ7Q/U0wdGIiVrx7LjtgO9JqP6MBgPLEAvOQ9LgQObzLrcGXGrB+3vR5FGHqE4znnIdnhevUHsBf02Ndd1xjWORlxuLvAFZAO91sZdkjdWDj6PLAbbAvchjv048HUfBknI3WDgs8A4F8WfazSgLb7r0LM8MOHW5lm6jMoiGI9ErNKwBTLTh8FfgCvIp5FhwAIfBlNdFC9sZvxW0Ssc1Yj0aYqJdBGwSwupwdOR/AeAbdVnIXlrHOIMh/swGNvkuIvR9n4xsm8+jWTMJJ5zMFKKymAiMur/Dwrs/qspJCuQ8rIepbmMBZ5qNJjtSo+hML/pKSIdiRbCJS6Kr7LLJ1AxfzUFF8W/RjJ6kfg1BHjIsip6HD1OqGbIX0Cxv/5h4IvNRtZbHv4QYHxWZnJR/JaL4tvNnDILcZmy4w5ABHW/Ef4qm3vatTmMigu03lj9gf7m4v0ZIvClJn9OcVH8MyOIW+x/qcv5fRh8De0Q1wC/TaKeTO5/Erg0ZUUAiTJlOX8NXBTfj3amoqivQcB9veEY6FFCNQ2x3nb/e2Bqi1HnZ6Mt7iy0RSX33CatXJk5qZ+ZnMpgHlLo0lFNNwCXpOSy4SVD9iZTTShbA+/a9jootcC+Asx1UZxrXvJhMM7sw2+5KJ6BdpKL7Nx44CHgrBQnTTC4u0HiLopfAvak2DkwGHHWSd25TyP0GKGar3gBMsfk4Rbg6FaMyEaIfzHO+Tyw3IfBMT4MvozMSpPMi5R4mc4CLk4I2JSky7LWAh8Gc1DW6r6k8q+Mc30RmOPDYAckDpTBVKTsJRiLZFTQgtjLuOt0FKKY97/2A0a5KD7HRfGzPgz2A95wUfy+D4MvIbvx0S6KH835ehlFsiGs6MXuSETJw1DgkXZEfhWhRwjVhP0HKA7kuM3MTy25Ql0Ub3BR/NvUoVnI4H0esJtxgVXA73wYvIjkwfuBb5sN92bgv9KLxLTl04DQ5L61PhU3asbxGcAjyNVaBpNdFD+V+ntgavd4AhH/t4F7inYVF8WdGYVlNlp030Ua+v4uimtcryaXt80476L4LWSVWFFwyXDEWeuFZLaMthOqcYCI4lyeu5GfuZ04AYkXVyYKmYvihS6Kd0fJf7uirXI6Mo8976L4R5kxFgL7pqLdF2NmqgTmTHgK2L6Rwd/EhKczh7sWpi3S9aj2QClznA+DgxCXnEHF7JQXlgjS+NuayGfEuj/FMutY4AEfBoPaeV/oGfPUpcChBeceRdtU24JKfBhcgRbFqYjT7AS8CdxkARgP23UDkItxsIviU7Pj5Fgc/oCIIBulNRGlWN/qwyCsI7och8mRdv+xKH05jeHA75uQI2cD01wUf2AMYV+bx0C0YzyAFtxIpPG3nWBcFL/qw+BAZHkYnHPJjsCtwGHtvG9bOarJiN8qOL0YPeS2BTb4MPgWItL9EacehjjrPyCZaYhdl3D5ZcAKn5NykoOXgSqbpsmn77koPh5tqwt8TiqJyedrXRSvMuXuEETgb6au+QayHJQynJvL9aXEsG8iwZkogv9+pFBNQ6UsXwd2Qhyu7XBK8wmR0pmHQ30Y/LCd92wbodpLvKbg9HvAwY1cos3C3JxTXBSvNvPWu+jhRSiSPgn+nYsE/uOBM4HLSrgol1DrQTsDJRmCtt8OlFZyZcorNhDF1F5ic3zHrj3FxkwqunzeRfF0pAiW8Z/PRoEjXTBLxmTkcr7bRfFJdo/zkYiwvVkF2g5zspxZ55LzbYG2BW0hVFM65pO/1axB3pMydsdJvnt5O39CCtWlLorXuCh+14fB95ENdJopYUtQ4ltunKUPg2HGqSGlNZuhfZSzgG3bGY5Ehv+vI0IahawG72dMTXchcehlHwaTkRVihp17CDin3j/lw+BYYGHa1mwG/rnAkSmj/1HAKqcA6WmI6x1VZ9y9fBg0TD3PWkcSmA345wVf6wfc3IKzpXCwduA68ouRdQLHmx+7Cz4M+hes9FlIGG81kW4p0kpf8mFwrMmlH0FycVoBOA8404dBTbSSGfgXIZ/+iNTWPpNMRJZ5mPZFEVY7mSVitIvim6jGnTbmRMTVj0uJQI8DJxeJI0Yk5yAvWXJsAGIMMy2YBFNgzkWcOxEN7sw4ALJIzEpF4lqySK4oOu+ieBbSPfIwBIiKCL0ZdDuv37wlRVv+j1wUn1/wvStQ6NhOLorX2cP/C9JmByENvCmt1eS+J5AIsMDGyBU3bN475SlWdv4QRAx7InFinKuOdmoKxu0G5hAxPgweQ3EL56FiGStS574OBC6Kz7O/+6GQwwVpA78Pg0uA110U39DkvHZGys+jKMe/045PQuLLjsCJThFpRWMMQwmQWxVc8jMXxXV3jUboFkc1A+/lBacfLCJSAFMElgBJKN75qBbU/khBeMCXi3xKYzXQaQR+GfVdkr9FBvdcj4q5D6cjrjOqO0Rq492ZR6SG05G8t47UyzYueRaypCS4BnghQ6STgB2aJVKb1yIUEDMM2UGP8mHwCMoWmAt8pB6R2hirkKhRxFi+Y86JltFdljyPfLl0OXBiie+fiKKTNgDHogcGekgz0INrRglbi3mNXBTf6cPgFB8G43JMT7go7vRh8DtEBF/MG6y7xFkWNr+8gJzrgJtdFK/2Cl2ch0SSrkxV47BzKfe8izAAccQLUcjkeQ1EhhqY2WoW+WJCP+R82bZVhbpljmpyTV4wQieK6mnoZjT74R3oBZzkonitV07/08gG+QAyAZWVWftR7d6cTf2AlF8Aq0uaq3oVRphfAn5hpqkbgcucgltOTl36PZR+XTox0Ku4xz4+DH7gw+BJtCCWAwFy+55iokpTcFH8K4ozXMeQkrObHruVL5kG/Gfyuem/uCie2eD7/ZHX52XkzlyefMeHwR+Bc10UP2jXfR15b/ZPy24F427vMs0YfBjMB65xlZjVvO+NcRtZ/SWzDlyAYhcWu1SullkynkA7yF3A5/I4lVcG6afQtj4CmesGI4VzEXIK7Gzf/yD1vXHIGnFbIhs3Me8RyI6b50rtBHZ3is9oCq0S6gPkVzF5B6U0N/S0+EpART9gOxfFHeZv399FcWhb2ptIdu1EL21OC8rCPkiO/kw7PWJ9CVMaP4mCuc90im0oujZJfalq0GZEPBV52b6CzFwvpc4PQ4ugAylTdZlE5p7HIFt2HpagpMam3kXTW78ZmfOItBM4paw70OyRSUTOd8zofT5SHgC+CixzUXybi+LbEQeZanPo58NgvA+D/cwMdZSvpIxk8RRyOJxQ6h/cNLAGBbPcWo9IoSuAZ32GSL+LHCJTXRSfi5TG+bYAku+tQqa3pcDrZqYqBXtf9xecnoh2yabQFKHa6iyS+X7jLLmsLGyV7o064r0GXG1+7CFIvjzd7jseOIIKEQ9GYXi7oXSRC4Fn8ojV7JVT2QhqGLQRK1G587K5ZV3wYXARsrUOw3z1xjR2QbLpkz4MLvJhMMCI/Axk376uSSvM6RRHb12QZ8Ouh6a2flOg8gh1Jaqm13JYmQ+Df0aBHEcikeB1F8U/NhHgBRQZVbjt+0o0/SZZ+rsZmKK1rtnt02zX/27P9TvIgXG2i+K77fxw4K8oTuFjme+OdU3W+fLKhr204PRVtghKoTShmk3vb+QLyaebO61b8PKBX41cl1ub3Pp95Bc/Muf6UcDqVk0eHxbYYr8OVUT5olO4HmbtuBkr3IYUqEXArHbI88Y83iQ/LrkDveNSSmwzhPo9MkERhpaE4zr3SQpAzEHRTvcgWXY/lMoxCKVtvGWL52IUMbTJNlLoSZjH70ZkBlyDbNQXJM4H484jkfJzj6uN0+3u/Q+lOsshjd+6KD6lzDilCNX+mb+TX8ljf5efBtEyTNZ8EuUtzXBRfK9XEMZEZE7ZFnHxNXb9acgX3/UCtqBLc78RiU0P2rFRiCgHIEfHYBRbep2L4l/20DyeJr/gyAYUJ9FQpChLqEXc9HmnysZthxHmecAfXRRfW+L6ZOX+wkXx2T0xp00JPgxOQArpqVkl10SBb6JgmUdQivX13bjXMGB7V512kz6/B7XZDglKcdWGhGpyxt/JzyTd2/VMndKaObg6AddeaR93Ia/U3mW8YpszzNT3GHBYIo/mXLMVItJzXRTf2eJ9hqGdbCTKgi0s0mYesL1yTq0HPtHITlvGZHMs+UT6bFki9WEwykVxUQZj0XcmA+vN03SCV6WR/kCMCHIoMmvtY/O7CriwrB13M0cnigzrssJ4xfm+ZTEO45B7+izXQnVCWwgzUYztEBTd1ei5n08+Vx2IAnLqV7MpMak/kp9AdlijqBr7/j0ol73p7dhMKM8nLjdTniYhLXIociG+g1I0tihSdeDDIMnSHYt2nxmuyXI8Xlkcs5CucBkqn3kBCl+s6za37/+B/NSblcDH673DuhzVuFoekS4tQ6SGrSjW+urCRfHPfRhc48MAF8XPmxnqWftslPBhMNKVyGboA3wJ2aMvRinhpWuxemW/zkIOootTill/JGI8ZNeE2ViLDC5Fsa9ZDEeZCIWKcCPPVJGQWxSDmochtFj/yDALhYj1eqnDFtG2ribtQqLsoEDoqWWI1Kuk51d9GLyGXKyzXBTvCQzzYXCdD4MIMaCTUOG4e4F3fBic5osbVdxOcc2uugpVIUe1bTbPv7sOuD7n+hFo1X4OmZUuQTbW4VSS2r4OrDRfcClYLOaVqMbRZ7vj/eol7EsdztBH2AsR0imNFE2vkMokYm0JSiVK3t8BSHGq6mJoVoRjUc2EGa6gjpjJx1cjl3cWe9TzftXjqEeQ3zP+zgLtbjQS4v8DyRyzUIbkqymNfToWBe7V/KswFyeDq1D9p42qB5JXMuLE1N9DyMhgPgx29n3faOxeF8XT6hGpD4Ox9j5eRPbNKSg1PCHSnVHM8M8TIvVqt/QNFPI5DekNjeqx3kCqEEcKSWmjXNSTUcOC49flHXRRvJjMFu+V559u9TiGSjmcL2ATNlfeLOR3rllRRujn+zYkibUTLooX+zD4tg+D05GiMhrLpTfzz8XAQ92xUbYDRaY981rthYp3jELR+We7KN7gVST4TXP2fBPVTjjYvjcSuV1PQ4S3t4vi5T4MLkRy6Ol15vKeD4MnyBeRjkHWgRrkclSb3H45p95tUlPcBW0HyZgDXKUF5MfQSgRp7ocCTxpx56KeLbWv4FT//u8omONcYKAPg+uQj7vPiTQPxglvBf4byYaXuijexUXxLUakuwLfR+lArwEfRe0qt/JhMA/Jpq8hxrQmZXo8HxWoO6LBFIrKyo8v2n2Ktv5Dye+QUWMY9iqJeJ8Pg8d8bTW3Hak0j80WlR2LgnZB4sBaVJ3501417E8278pGD6f0kDlUEhW/iuS46/tqTkUweXIeWkifdFEcutqI+wGIY85GNVbvQxm5rwH3ORX9uA1Fu52cEKbFexwPXO3D4PI6oXz3o6CUPOSmwBQRalHdoLuyB5wS005CAQ8PJRqfPZDtqdTV3J5qjW8cFTFgLLKFrnTKXN0b+AzNWRd6FV7dqLtkeCPWn9mfZ6SJ1BZzd1pUtg1O+f5Huyj+UZETxlyhv0GRci+gxMHzkPw5LXXdCiQi7m5WgmNRiGZ/YMcimdgU4qKmFrl9sooINU9+eM8VRJMbgR2JZJwnTT4bC2xIRVVtjXkmzKIwNGXg3YFUF2RT1hbQPbNWS/Dl29O8hIr7fislOycNzRbZWEN9GFwGHORKln1v4v49Ah8Gg73iSF8BtkNB5ych79F0YHRmp1uDCPM5xFzOcVH8f0vEgNQwPcP2eeatGuXE/OZ5LLswOS6Bi+Jf+DBYiiKfLkGFupJz6QIEE6iuxLwLte61HSjXc75pGGGNdJmO1KbUdVBbda8GJsudjsVz+jCYTSXZcYRX76fzUZ5XM1FJk3wYbMhyOx8Gw4vMPu2AKUhnIxPj71BPhaRU0DUobftlHwYnAn+wBbUvelbXOdVpaAZFqSr9EKO8LXswizwlChTA0BCuUrjhYtRA6wpzvaXxJxfFe9uWeBGywU3JrKTdKY646RZMKZvglZqdRlVwti/Ow0rGSWSyhcjjkkSz34HEljkuiotqM6Xvk87m7Yfa+6TPn0axTNcyfBh82YfBd0yxmgc851Sa6KoUkV4C/DmJCXAKdJ6DxLNpLoqnN+uKtXFWUNxfYP/sgTxC3TPn2AZq64TWm8RCpCWuQ0L7HB8Gf/Bh8HUfBkMTO5yL4qVOyWXbonI+kVcL7pOpVsTaDqcY2t3MDJMgq602LCBmMt90JNMlhD0EeXIaEqkhK2odBl3b8F1Ifu8JR8f+iKkkC2OcD4OukvBeSYCn2e/7+DCYaHbjpdTW82oFRXHMe2UP5BFqXqXoxc0+KKcYyJNQJb8DkZA8DHjOh8HNPlXixUXxcqfWOHvbd4aixTE3x5LQTpyDyvrc45UGk5UPcyuo2AurSslxqmGVeKR+kiVSHwZjfHFlu4Mzf3/JCOJF4DGzUbcdxg0/46L4/yCCXQRM9GFwgnkRpyBP41JUtftKm9OARh6ukijqgbVV9vlWEapXtmdeVZKWOJuL4seBG30Y/NCp+vOPXRRvh5wGp/gweNOrWsfo1HdWmG3ys8gs0mNVTGzrPhotzirRxrT0MZlj4+17S4CveBVaS+OVzM8ktfs7wB5OZTC38rW1Wb9gduYEA22MV10bctHKwEXxBxb4cwuq4XUkCjJZ6qL4frMS7An8k4vi37fptovI91JBpgpP9oEV9Qt6odWZmF9/tVchiOTYE05Vm3dBsaXzfRg84tXZpL9d84GL4t+76qYSbYVxrZORDTexGyeLZq+cr3SJAsYxP+nD4BlfKaE5IP3TK/rsFVSzNOG2ScfqNAZQ2f5HpY6N92HwQ9+L7RzN2H8ZBR1rXBsTKU10KLKG7JL+I0uoRe0N6xY5KDGhXyJb28jM8dUmuO+EtuE9gb/6MJjjldvTdvgwGOJVsOJGZPM7GJUofxaZWuaZWLJ3zter5HeTrxcCr5n78B/t1AivQJrngMtzFlteZbuDvUpdXoq6Ef4aPfcA7T4XesVH9GTLpQloF5vZpq29DBYVHK9SwKsCp30YLKD2Ia50UfxP7ZiRb5BSYtdMQGaS0Sj28al23LsMjAM+grbeDuBRF8VHp87/q4vij+d8bw4qVtaJFn+ynU13mWRDU1YuM3k8OfYXFGU2CBFpr6fTmIXjdZTTv10v3vcb5FcAfM9F8SeSP7KrM8/P+kbOsZZQxlfvovgNp5aMB/YmkRqWAL9ChDqElJ3ZZNaRqb+PSokps4GfUnmeSaXtJCV5kFfyYYJdfXX7n/5INxiAwvHqmsV6AqYsr0Q7RG+iiL7GpOX2LkL1ikMcmfOFthHqxggfBhO8IqAeA/4L+EHq9CG+EiSTNVWdjlzGQ6CLWJOshwvMF56kJz+DlLYEAzEl0Ve6BSb4IfA3Hwave5XWKerX1ROYQcEiscXWVBmekqhHX12MM81Ri3zRfy443hTqmGb6DEZEg5F8ei5yMkyxTxKqNs+INWtfHoIUoOdSbs9V6Z9elaD/gPK8sgSwd0pkWId85lNSn1OwFB7fS25VM4OdVXBuHbCPD4Nv+uYrgde75wcUN1jrosm0C7XoYdQtEGvb39B67j2vqO5OMnGKxsU72qlJNgNzUxZlx77kw2A1KuAwj9p24EPsuxOBF30YHExF6x9oXq+bEff8gNrmYd9CMuka1Npoo8gDq/ceXRTfbiLQjV6Jer9ukyPiHfLt91002S/vYAaN/N63orC2elhPxj7rK3WJNrpqzwls+/4ZWtBZjjgE5QAdjxwZz1Ax751EJejiaPLlzsRtevrGQqQJ6rmOza56NAoYusNc5NsXXV8SRTTWpUz1zzuYQVEyVvr8J6ErnfYxFGf6EnKLvo+8TFWEakEdHeQHwPQZ7KHvhbxSe1A9v/4+DC50qsI8GDX+vcWHwXsoXjMRbyYibjvVKQtgd2CILc5svtDNXqnMz6LYhmdRLESfFB32ipya7cNgb1cno9ScOY97VUGZaR7Ex9H7f7nJXbKIxrqYZ5pQ86r0rXZ1ql8YXsQUBaeGA48iDvq63ejz6MXtamaYDWgrfBdti4cZwb6FFUho9F+1G2ab3BER5kfs8FtU5/+MRsWAf2DXD8bqfzq1J5+CquFtg7jN1FQE1Dq0UO9AQenrEMFmX2Y/m8MOPgyed03U5W8j/gmZyq7wYbAC2VXvLzKXWVzHQq/AmqPQ//UFHwbLkaI00zx59fD3guNdyn2aUPNSXMvkp7+T+e5jqNR5V5iWeVZudlH8afs7qSk/Acl1ExCxb28P5yHgetdEOe7uwBbHSzRwbNhCuwClaUCqUK25R6eg3K+LMhzlv9H/ezgizqmuF0ohtYg5KBBlLhJZDkExF8NQ+OajKPajiqHY/3sDcIPZwvdBdaUaMTooprOu3SxNqHk+/jLRMUup3h6XYl4dr4jvg4G3MWXCtr+DELd6FfhXp5aIiejwItoKeo2z+jDY0aVy3c3GORTJkQNTP59FdsbEVJVUExyGcodWI+tBkiPWaS8wTbRPoSilEej5rrZxVgMr0rbm7LxSx/v11M7joniND4NfozqqtyE5/HbjmOKEpCIAAB+eSURBVIfY//cFHwZL0M7xF2TleDAhSqdOjV1mJ3ueI1wm/jeFIjrrosm0MpUnK+ayex8GI2ziiaF4WMq19wGKAj8cuWRvRCFwQ+2FLkCml0nIwPwPNuZYFMN5oIviE+tpn63Ch8FwXxsbCzDcV0etDwf+iAoXv4n89c/Z3CejriJLqVgMdiXVp94rrvZJKn77FehZrkeL9GqkhD6E4ij+bL+ne69+m5wGY14xEwMzx/Ly27qDK8l4KF0Ur3NRfLuL4mmo08o89A7PAYYUcU57rm/btUUo8sINSegqzVHzNL2aAXwYXAx8A1jllQd+O+IISdT+KtSO8W7Umjz53kD0Qrvyy71CyRJ33WjkOmxnm/SBwFhb4bgoXukVEzvApdJqXBQ/7BUU089F8Q1Oqb8HI01+ENLsH0ZcM4+TDUUB50/7MDgDmaXGYc/XOFPiAOhnYw5G5rofoh3kwORle8WBfiIr25k9d7ApMsmxg5DI0raF7aL4fR8Gb/hMQQgfBoNdFK815nQ9OYVIUtcehZL/HgN2c/WL5BURapcukOaoeauyRnNzSin5PyiXJunLuQ3iqoeilTbCh8GtPgwu8Opasj1i78syQvlqTIlzUbywnURqY64HjvDVbSR/Cdya4/GZCVzjw+Ar9t1XkRG+E/mih9fZbpPdaEckuiSG6ppn6hRovdau+R6V7tvLoYtIzyFT3c6I9FxUPic5dgyqS9oTKSrXIcUvudfXUFZqXXi1g78PFU470kXxrxsQKeTQWQoDIBWU4sPgf6htcFaqIYBXmNsMpKXNNS14NCLg8Yhrnow0/eTzVxQZdIiL4s80ukerMFnwFVR9cLEd+wbSTvd31b2VrrF5nuSssYVx/SvRVr9LQhTmVRqPVvw25NuhX0Wi0FpgvrOWlV7Jj39Au9iBiWJlRHoxKgfZlWdlRDoP7Ub327FjUF7ap10PVDI0XeIetEjPQ03lrq9z/TFosT+AmvSWnpOJSv9RcPpjLoqXpwn1f6lN9muqerNttScgu+p1mW0jaQT7LHrBE5CsOhE1HeixCngmrvwzEi0W20v4M+LmXcRqRP1XtGBPSV6MD4O5SBN+CdjTRfF6W5zPkG8tyeJV1LFurRnTX0D//wxn1bRTRPoWspokVWQSIn3WRfEX7dgxSLyYUY94ugOvOlNzURTZ0Xk2VRNjEk6/DDkvlrVwr6EoziIPn3RRvCxNqP8ftdFUDdtXm3C/FHkXvoI4zAC0rT+YEKAPgztQ5ZDfpr7bD2WDNlXktxGMm4+1z6eQIH+QzWkRIsRxSNlZa/MfYJ9RVHaWDdQu3nsRZ+s0keJJ6kc7vQ9MMbm3H1KasgmU6fusRspXh322t3PL7NOBFJ3+yBz0Vyq71LLuPkuvTNy5aCH9BtlB12Wu6Y+8kbPR+z7TNVH4LueeA4H/t+D01i6Kl6Zfwgby5dSiwfsh7fUE9A+dm+JASa/TpFL0UCS/3efDYERiHzWu0W4iHYYUs1FIFBlBhZAGIHkyIUoQUY4no0kb8mpdDbPjHUiBWUt9Ql1t16TvX+8+Q6mYZdalziUmszRRD0My7jqbzwYfBuuLjPNlYGLb3sCgOtzxRpQ5/ChKV+lukl+9YPANUP2A8gi1HuHORS/gk9lt29yjOyNucq1T6ciJyDV5pZmi3kNy2svI5daWQGEbZxGpyHGvlOwdUPDHQltkryECO9qp60p/RNivoO38bColjM5HosMSZKzvMDFhAfll49OYiHziB5vIcDBSuLZCRR2S/KPkHi+hfPm1xrWTRh+vuihOipQlx37n2pe/1IUSjpaVaAGe2AYihfp01gHVlJyXN15vgHNcFJ+dJ1v6MPgd2hZGYrZAF8VLnDJNj3ZR/Hk7vwp5cv7Th8FzPpN52A54pb98DSNSO/w1pABNc1Y52ywOpyMiPd1F8S9tG90HEdB7SJ5NXsyF9r8to1hrXYW25JFY4I4RwYHoRV8MjHHKwj0VldecDOyXyKguin+KntFBXpmyybGZwIW+B1NT6uAPqPxouzyHDQk1LaPG1AZOX+uieEYzd/RqFTkCtUNvGJjglbu0Aji/yGjcHXiV1JmfEKl5jP6M2tqkW4uPQ/EJZyRytBHGI2h73c0V+N59cevNz5mZK+87eyAb4xpkTVhqx69ArtZPp5+f3eM4F8VTUse+gTjv9SUeRdtgz3BU0fNoYbxRwL8VnP5HF8VVdtS8uMJsDGVDuCj+jVNadBkiHYo6mcw0jTjPjdsyTKm6w1VX8vgW0paz3UCuQMSbEOl4FBHVHwUTr6zDvRIu+w7iloncnVvdxMSMN1D6ynDgETPR4FQa504UU9AFpwa9N5ohPTn2K2CF7+W6sWb0b2fATJGM32nOhaqtP09G7NEQPKcs1Hegy5b2R19d3qa7WO5SJRXtHk+4TKdBc1TcnLKdDkfa+VD0jG4G/hP4Xx8G/+XD4K8+DF5JOQ1WIRPUbrYAdkNbflKZ+SAfBn/0YfB3Hwb/Dfwvshv+0L4/lpQL1kyCnT5TK9QIc3V6wbgofrDdjpI+QBGddcm//fMOlhigJzAOKRjHAm3J5c96ksxYX+XF8fKTr3TVXV7Wo2CaoTmf45CCBDLyv4SCM/ZMVr+L4mU+DHaj4qsfSyX9N4nZTAJR0p+u+booPsfco1U5RS7lPt2M0BSh5rnh2roV14OL4kU+DG5DZbp7rOhEzn07yFSCMVm5JunMq1hZmssliX3v2/lhSEk8P6NkpkWonVEY4FMl5tawguJmgiI669rl04Sa5xnqkSIQdXAu8LYPgx2KlJCegHHVXalE6Ofh08B37ffzkNbfJVuZyS0JnN7HzFGJrPoPSGF8Au0YD/kwOI/iYAyQE2KR+3B0Iiyisy4be5pQ86KsB/kwGNYuG2cjOAUf34TMRKf2xj3tvh3AUz4M3kVeo32R9yfPPXqui+Kf+DA4ByNUk1UfSF2/A5bwZ67HwWgbO97OH4v89Gm8gWJdnwae6kmXchmYYnsaWmRPugaB3l6pKB2tuFApToPqyqXqn3cwgzHUX/l14VUeZ2Wer7gAl6EU5Jk9Ya6qB6fan9faJwnkvpBKWcYPnAV5I2fHP/rqbNMVyDS3HHnHnvFhcDSWbWoG/LOo7t/1c1QRpseK9LYCc9I8iP73h3wYrETOmaeRqPSqqw48WYCYy7IWbleUWNrFPNNafz1C7Q7OIb9kSy6MoN9Frtm+xijEYTupuEETrEH1VJNs02lU6tJfioz0gxGnPSDn+8nf/0xxTYU+hb2LJAv302jRdgJnAP/tw+AOXwmh7I47vGEGdJqjFlVVG0+lAkgrmIW2wX0aaazmRToEeSpOR4XCegy+fuWPPYAIPaOTkDiQLri7BsUvfIC1bfRhkDRKWO+i+CofBu8gbjuGSgeYBL9AZqoLkB31MCrNN2rQW+JXDkaiHXEt5u42+/R+LlWXC+0a6Wi5AcAXGokMhqKF2mWrTdvj1pLPVbtVMMtW5YXktxXEh8F4Hwbf9WGQpGR80a4da5E8PYkhaBueB/wrspUmn/no+Rxv9tVsmfbEMjDFVfKaEhn1owBm8todxTxkOeqTLop/hHz8Q1AUVvr+f0PBy4fTRLBQD2AktaLfUGq3+A5XXYxiLnU68SUwJTTPdt5JKgs462nJqwPUjvaIP0N5SfvY5Hb1YXCxD4O3kYvy40jj/6iL4uOdAoxvQkEbPQYXxcucyl5OBf4vKhWeDvK4wVWyabPFw+Yj1+d70OWqTWTZH3jLwTLrxU5UE/p6rEO2EWu6ovTtKDnyI05tIX/bm4qVr9R6TTAMGOVVuzaxcgwlRbzmUs16NvtRThQooq930zJw1vW2BMlTVQP57mc99kfZl7+zLeEDlE8V1jFDXYHqjo5ybY5XzYNTRNQ7aDtfT6X0ZHL+Ha9U7uTvdAT+Zcg1m6AfqlmFi+KbjNB+kzqfNTt1pO45GdX/71Vvk1kuzkNJjD9NnVqBIsnGopywVdSWKBpB7Y4xgGL/fRpFXcOrmGaWUF+hFoNssLJaO9DlhjwEKRl7Ia5xCXB3woXqwUXxGz4MnkUPaVYz924wrwHI9LQbtf//l9H2PRVlI2RRU5LRiPSbyEmxDiU+/ggFPHcRa+ZrC3LGvhdx3SsRQdyWOf8/yP3b1gYcZlaai57JTKey9F0wRpIwk596VaS+CBUU2cPiKEZSG9eQ1OZqhCkFx6toMfuiiqr/TqYBoZoiNAEFTB+GXtTjKPlvumstbvFy9LIvdG3qCmKc7GEfBovQ7jEVRf8n3pFpLoof92HwMLWy4TPpP4xIJwM7OaW4JA6Bt10Un2+izmU5xJqnYDzkovh6HwYfRTEA30Mv+l5UreQJ1wO5UbZTXIEW2dlege4LKLDluih+3ofBvsDolM10FLVi5AjEjRuhqBx/FS1WEar5qBNbYBq7kMp+zMIrWe0F9LLvR7bQB9vwYO9Frt2TkZbcNtjCuc0I8jUqhJosyIeobbX5VPKLVwOJV1x1TllH+qcR/GeBb/gwONSUq3XkV2RJAmVeSx1bhhL9etQ75Sy13WTQA5CsPseHwXr0Pz+JCDfJzNhAtTI1mlqFaBQNKu14ldPMq8nbST1CNSwilSZrKOy3ZFvp5UhTv6ldnA8UVGKuxqfaNWYOfofMKheh1JoET5FpzJW8KIuf7GoalkJSt2pY6judwC99GAzzYTCwwInxRo4cfjAKrL4amcd6HPbubrdPQkh7kU+4C10lcLqDlKhk0V2jaFxroMiq81aWjlz2Cl8cBPyJMrLlpgQLPN4aycEDUOjdZ51lz/owONy4TZmxTkBmrn5IMTosG05Y57tHuSi+034/AmVPTPFKersaeC0rO/YFzH66BzIh7oXSlxZSIdykNsEY4G8uiv+fBuPNQwmhWdSk6edx1KKHux91tv9NDWaGWWExngDrfRhk+3OWCqnzYfBVZPPsoJIkeI8Pg2muNkA7D9n7RNBVQGO6D4OvphSXPoNFid1in2Rn+RJyhlzkw6ATyd9/xZLyGiCvOTTktDOtiVh3Kn+TV8yqpj/lJo7lrjbF9470H2ViDbwqiFyI/NyJvHok8jjN82rJUxcZRbMT23pT568HlvlejuRvBKdcr5tcFJ/iovhTiNM+h8rIDzA5PhcWFJ4XNZXbzrQotSKPqx7g21+Mq89QIEs/SK09sBBexSFGoPyma1PfXe6UgLct8EULgC6Ll1xO1TsXxe/1tm21WTh1Z7wBWVL2BuqJK9mGyQmez2MQRSv0LqRppzEYaYTd8ftv1LCttpSlwrwxj2ainra2n2NRdNEqVI15Kx8Gg3KUr7w59Lhzo6dhCmQjH/+RBcfn546Zd9C2mP+kNunqJhfFJzaYwIcSvlKjCkTsZeXTDx3MnPm3nFOdSGmv2VFyt37bYvI456G+ja1bNhcYkV5KxXO1EPV3bSiffkhxbMHxXLEH6pdSuTXn2BBUp30LDKZMbYdqXM1EysCBKBDlRAus3oJqFNmFo6Iv5G790GW0/VdqNbOFTu2wP/SweNZBrpLcNwJ4wTTg5JqJwPstupA3O1jo5jM5pzpQiclcJ0EhRzWB+IacU3t4VRX50MNF8ar0VmWemiWZa5ZsIdIqnFJw/N4iIoX6Wz/ANeQ3fejRONFNHE/29QQ2VlhEXZF8ek2979YlVHMl5tlUT/Z1urt9yPFUX09gI8bXyS/vubSRu7lMJbhLc44NRklpW5BBnUDwDzXMWVRUZj8vtqQKDQnVKSEvLxb17M3JU7UFPY6Tye8OuYoSlXHK1tbM46qjUIGCLdiCujCGdm7B6avKxC2XJdSbyE+nnr3FAVCBV6fCvOMDksTGbow91tJA2gafqRbYg/gaCq7OYg35TLAGpQjVTFUX5JwaifKFegw+DPr7MPhBm8fcKufYt9sw9PScLM4k/eUKu89A31od2FWoE3VbGINXicv5PU2sdp8ibvqLsqa7Zspq30J1t+UE5/oeKGmewNy5x1vMZ7twtld7mjQuMvNJdzCW4qofCYFNoonKMQnshY6iNku4VVyH3n9P6xmzyQ/nW0VJbgpNEKpx1bxWPkNQGkdP4j2qc9+7ix1IFUcwLtWP/KrbpWBcsiMxs9h2nyaqJHRtPPBlr8ILzWI9TWYDp+Y3JIk98GFwJSra9hlgic8U+rBru90bwDICinaqOc2kLTU1GUtOywvfOtlXt3FsN9ZQJ07Uh8EcX9sysujaQSjz8cbU4REob6k7SXT7YIHXPgyG2FjHW3YuVBL/dkcp4+/mjNEInZQMQ8xBB3CqV7+vB1wUn+6ieL3tWF2+dxNd7kAVXLqLS8mvgvIOTSZrthIxfibKlEx/tx/qI7pTNwtV1MAcC8OBo3wYfBwR7AOoUMRuaCsdjRpq5WV3ZrEfitJJF8ndihY5VQpHAut8GDyHqsJsizJZZ6MeAEnQ82QUAd+rcGodNBn4jKvtZnKAD4MF6DmsQDVeH+vO/Ww3Oabg9NnNBoE3zd4tVSWveNkkoDD1oFn4MPieD4O/o55Mk1A1ucdQ1ug2KO3jIgsAWUr5KtVTMW6RUmq2QXWvWp3rYFQIeD3KHP2cLdh7qciAG7y6rFxWz6fdwr23b+LyFTlECkrhPsNF8adcFO+CUpGKajyUmdMgqjN603jQtVBJu1U5ZDb5BdUuaGPAys9RT9BtUXmXs1wU3+ui+B2nziXLUl6gdUVxjGmY3DXcVSrMJUrNZ8iUkDFxoqyicQyqcXqGzXEddOVcJffYgNKou1v2PWsxuKINSuB6F8VpRXkA+XlzZTGHfKVyLarS2DRaIlR7AXkVoQciE0q3k9BcFG/I5M7s6FX1L7FHroEublb2oR6AOHISIJHUL9ge6OfD4BAfBt/3YfAiqlSyY8lxjyOHAL2KTiQLYAPKybrOq0V86WdkNQGSRXNA6vgolBtfSj5vAgNpnJOfC3s/3yg4PbvVlPuWCcpF8cM+DG6gNi97MrK5FtnOSsFewnwq/UynA38EOow4k9yiieRXIczDdGTrnIBW/cV2fAJSIJ5C9Z/OBW50Jeo8mcb8DjDaXlIIrHZRPA04x6uv6EgkGryNuGpRLdrs2CMQIZ5JRYaeSiVpbiby7DS1lZriexiKpc2r69W/TAZuzrjDqNQ2yOL5VGp60+gu5zsTFSLIsvnv+TB4pDt56E7dmEPELZ9xUZzWTCdRKaI1CXiz0XhercOPss8KJE8ebWaia9HWnXDpQaSKyDZA8gz2QtvydCpdVkaisL+lqP7Weh8GTwILipQJm8+lyIS2AqW1jEa57v0Q508UzO1pLo19Gx8G/4YW9svAKwWcvVWF+DrybaZrgG7l2nWLUF0Ur/FhcDx6GVkrQOTD4HOuG7U9nRXh8mGQvMDtEQdNByjvQjkD+quonOJdSHnq51RqcjJqQZm26Y0kVT25CMaZX3FRHNrfr7vqqtrrXBTfbfbLRAbsRya4Og2nhhvXoCzWpPLIEcD1SDe4ERV1Oxo4qUkry/vAtlkznA+D7HVNi4Tm2StKuzmjRXNcF9ohSz7rw+AnVLrQJRgJ3OXDYM9mTRGm9HwH5cWPR9xlHuIEbyLlZ5gPg2VIjmwYWufUIfBcG/9MKpHmo4EnfHU680jKlUw8FCl9CYqe53Eoh+p8u6aunJbeyk05Xeai+AMjqN8jC8XMMgpkBusa2YptN2mKLsyacXHB6ZtcbdnNptGuzsQXkB8wvCutuQs7kYvtPiTzveGieHenDswbgL+gfqEvAu81Y6i3wI6nU5woKVs+O3XZKODfG4wzFHVYTi/CAT4MLvBhcKNtqck9ViMuDiKCZnaZw6kkvfW3WgGL6bkA7RE04aEz71PS6yCLt2hRy8+iLYRqL/1o8jnFaV7FyJod81qnXvTLqS5NOB2VQFyK5KzCzMUCnAnc4sOgnw+DnYHfGyf9UirgYxQNans69XFd6sPgaz4M7vNh8O9IVh+MuH8nFUIdTkWUGEBzGvVUVJ07jfm0wefvw+Arqd+T4JThlLSimFJ7H/lxpmtQobi2tGBqW693M2JPI9/Fd7lXY9xW0Ek10fSj8tLPQSGIpWALZgJwD/Ia9U9x4/eplEH8GOVb0SxChLk14u4zXRQ/bos3TahvJ/MvuwOYO3NDykifvK+7EQG3BB8GQ30YzKW6gvZwr0qOIygnn/dDlpIdck53Aie6NnagbhuhArgoXkx+lmE/4Nay/vjMmJ1Um7o6nVqmj0Hb6Xk+DJ7zYfAXrwZmufCVVIj1wOUuivd3Ufxs6pI/UvHGjKbk9mxZpneaMpaVxROCHErFhNbMM8/26Opv91yJuio2nbdm7+Ah4NJEWbUxFyLX7iwqi6oe5lLM1c931U2Qu422V4dzUXyLV7xnNqJqEOoAt6eL4kKtF7q2odFodY8EPubD4BSkWI33YfA3VPF4BSKou5AJqHDLMg3/c3WiyX+ekjfH1BurDrKcMhlvOPAnEy1KxZPaQhznquuzpon8AdRzoFQvLpMlx6Hd5IsmOmUxCylqua2WUmPNoThn7noXxT8uM6dm0CNlDJ16hX4SRXanMQxY4MNg9wbbwuFoa1uGtqE/I1nobKREjXUt1MDKEqkZ6P/konhFRika6koUNMuM1R8jVB8GX3ZqQbTMoqeW20IZQ/lqgZdTmwyXJtS7kW21bNO4U21+B2bcpV0wmftCMt220/Bh8H3ktcvDoxTn7XcLbd36MzgV1fPPYgQi1q2Kvuii+CcuindxUXyci+JznUo6Lkec6QLUY7TlLFgfBpN8GMwHBmeDNIzrtRJKNxQFnlxKxWY6n0ov0Z0RY3i24PvpORyFLBN/Sh2relfmilznwyBbdbEIcxAnzTPlddliXRT/uGjX8WHwTYpjjxcDRzZp1y2NHiNUm/CR5MevJg1tt8k5V4TLgTNt3OtRlH5TbdrNl/8Y0vxPSW+rKa13Aq01np2I3Mf/YbI6ZrU4FSl8LyFb480N5jga2N1FcTZesx+1HqPHUdeVhjEJLorXJfPKweCC4+l5fQe9gzwsAfZtl4afh57kqEmu0FTyuUhCrEUNsbrgw+ASFB73cmrcucAdvmQOkQ+D76E+Vxe5KD7J1fYW3dErhnIy5WMH0jgSeNypgG9yz2OAxS6K37UFdiYK2tmrYI6JwjcrdWwPI97+1HL6xK/+nA+Dx3wLkWvGLOo6ZLxy1rJt2xO8A+yd8zzbisIiae2E2dseI7+n0CrgYBfFNfGPZlS/BAWILMycG4hqbL6KmuY29H75Oh0IbWt9DXGXmcYNS8MCSPolLmPj9vNsbutT1+2HlL/ds9uwLZRn05zJiPcu5KY+x0XxR5uZV4l5H4uimj5bcP4SiuOM30X/R893VuzpGyRIGYf3yjm9HjXH/X3q+kNQE4M5RfECZhe9AilYZ2TlzRbmmLQ1/1h3Hr79r1eiVpE1c/JqQDbQRfGMkuMNR164NS6KP9fqvArGHg3c6qJ498zxAWihFdWKegNx0l7p09qjW38axiUORDGZWQxE2/i3vGIvD0XR6Gc1eBC/RorLUcC/+TBY4LvRkdoWylXdJNLhyGx0ep2FM4sSEV+pea1EIlSZluJNweIFqmrh2k72GMVEuhhx0l5rJtxrHDWBmXFupjif5lrEHXu0W90W5MOUyvlUYhOyWIjEmbY1viuDXifUBD4MLga+W3B6ETJ1bPKNFzYlmOgzj2IrwC0otLDXmUifESqA2UKvJN/x8AGSW9u+3W1BNWyXu4hixgHwExfF3cra6A76lFChyzsUkeofmkInSruY3WxM6xaUg5m0bqU4P2w9cKpT/6g+Q58TKnT5teejtJI8LEbROK3YN7egAObVupzirX4ZEsHaWaWmJWwUhApd5pCrga8WXNKBgiV+uoW7dg/mvr6G4l6kIL/9cT1tyC+LjYZQE3i1bZxLbTO2BEuAGXkOgi2oD3NqJP76vFI7IIZwnovin/XaxEpgoyNU6BIFbqa4n3sn0kDP2WIZKAfziF2OQiWL8BbiohtdefeNklCha/V/G0VLFa3+dSjQ4196MiBiU4bFUsxBUVxF2AD8CimtrRZh61FstISaoKQ8tQoR7K+ajSPdXGFpLBcgr109D+SfUCTZy70ysRax0RNqAh8GJyBirBfatwLZZa9ybSxEtinBUk1m0phA1yDl9F96Koa0ndhkCBW6cs5nI5GgSBwA2f5uAq5IBx9vrjCD/eEoA6JRnf9OVCfr3O4G8fQmNilCTWARPxeguleN0mleRqLDbb3tn+5pmF/+FPQcylT0ux8R6Ca3eDdJQk1g8ut5lCPY9cDDKMX3/k2VaE32PAoFahdm3WbwIMoM3ajl0HrYpAk1gRHsWajpVpkU4g5UaeQR4NFGWbF9CRN39kDF0A6gvnkpjQ3A7Sgtus89S93FZkGoCSxg+WsonaOZtIwPUOblCyi36eW+sh6YWLMzKv422T7NdC5ZiUIlr9icbMybFaGm4cNgD9RE4ShKJK9l0In83G/Y521Urug9VA2lW7ZGS1sZg/LGtgK2Q0mFE6itKF0GG5DL8zrUTnyzczFvtoSawLbOQ1FtrAOoby0oi7XIdrsKFUBbh8SJDkQ0Sf+m5DMEEeAw+7SjnsIGlDR5B6qf1WvR9n2BzZ5Q07CEwANQSsx+iJttSliFUqQfQZzzQ2Mr/lARahZexYH3QfLgzliB3z6dVDWWo2yHF4AnNgelqFV8qAk1Cys6NglVtt4Oq3VFflnFdmItqp31BvC6/Xx5c1KGuosthFoCJjKMoaIADQc+QkXuHERFHu2PuPIGKnLreiTLrgL+y36+j5Sz9zeWmM8t2IIt2IIt2IIt2IKNBP8/CYLnlxKKRcMAAAAASUVORK5CYII=";
		
        $successUrl = "https://www.baidu.com/";
		
        $signCallBackUrl = "https://openapi.qiyuesuo.me/remote/contract/callbacktest";//如果需要签署回调  则写$signCallBackUrl
        //$signCallBackUrl = null;//如果不需要签署回调  则写null
        
        $operation = "SIGN";//操作类型；SIGN（签署），SIGNWITHPIN（手机验证签署）
        
		//$result =  $remoteSignServiceImpl->signUrlCompany($documentId,$sealImageBase64,$successUrl,$signCallBackUrl,$operation,$company,$stamper);
		//print_r($result);
        

		
		
		
		//---------- 6.1.2 PERSONAL（个人）签署页面链接       请求示例：
        $person = new Person();
		$person->name='丁武';
		$person->paperType='IDCARD';
        $person->idcard='420683199203047856';
        
        $stamper = new Stamper();
        $stamper->set_page(1);
        $stamper->set_offsetX(0.5);
        $stamper->set_offsetY(0.5);
        
        $documentId = "2357365074627539020";
        
        //$sealImageBase64为空时  可以进行二维码扫码签署  手机
        
        //$sealImageBase64 = "iVBORw0KGgoAAAANSUhEUgAAALQAAABkCAYAAAAv8xodAAACHklEQVR42u3dQXLDIBBEUd//0s42i1RiEBCm5/2q7BzbNF8IRhZ6vQAAAAAAAAAAAAAAAAAAAAAAAAAAwA+8RYA0ob//AXFSkxuRQpMahAZMOwBCA4QGof98HUIWTO/wtnbPI17e9I5cITSxi4mb3Ikj7SF0gLDpUo+2hdABwiZLPdMOUheX1ZRj/f8SknzXCW10JSqpVRA++zwQ+gqxV34O5g5+OS4IcdfBg/GBRIYXd5o8CO1M0Hx6R2hCl5HZopDQEVKrchBalnIkdCehLcQJXV5oV2sJHb/QlDuhI4UGoUtLDEITGIS+ZW4MQpeT+JNKBwhdciohS0JHVSQITeir58AzuRCa0Fcu4ozShC4n9cx7EJrQV0m9Ox9CX9bxMO0gtGxkSuja2fw2esuU0GWycdWQ0KXbOFsxITShr6x6uAxO6FihZVu0o7WV0IQmdOtsS5+GCW2UJnTRNcOOrYtB6KuFVsIjdHmhR7IzShP6SJufZHTip6gg9FKhd93JsjpnBwehHz2X+2SVhdCEHhb61D4bO98XhP6XzWJ2jfrRHfa0YwldZxBpIfRoXdRWBmfbveOZk22nE90eJn9rm1fexNt+jpwidPWNFFft1GTh11joSt9/tFpD6oApR/U2uSOmacefrBzc3jcuozeobnQ409hcPXA0MzXUf4RuILXQhBEltrAEESU1ECc2ECU1ECM3AAAAAAAAAAAATvAF4xQBVDXpm0UAAAAASUVORK5CYII=";
        $sealImageBase64 = null;//$sealImageBase64为空时，则在签署的时候 需要客户个人扫码手机签署
		
        $successUrl = "https://www.baidu.com/";
        
        $signCallBackUrl = "https://openapi.qiyuesuo.me/remote/contract/callbacktest";//如果需要回调   则写$signCallBackUrl
        //$signCallBackUrl = null;//如果不需要回调  则写null
        
        $operation = "SIGN";//操作类型；SIGN（签署），SIGNWITHPIN（手机验证签署）
        
        //$result =  $remoteSignServiceImpl->signUrlPerson($documentId,$sealImageBase64,$successUrl,$signCallBackUrl,$operation,$person,$stamper);
        //print_r($result);
		

		
        
        
        /* 响应：
         * Array
		(
		    [code] => 0
		    [signUrl] => https://expose.qiyuesuo.me/sign/remote?token=RU1DWFE4ZDcybENGV3A0WURxSmJnVjUzSElCdDRvRFFPYXppbVVTSFo5MkcyV3YrZ1lNeW1IcExzUjNnenkzaA==
		    [message] => SUCCESS
		    [token] => RU1DWFE4ZDcybENGV3A0WURxSmJnVjUzSElCdDRvRFFPYXppbVVTSFo5MkcyV3YrZ1lNeW1IcExzUjNnenkzaA==
		)*/
		
		
		//***********************************************************************6.2 获取查看合同页面的链接
		$documentId = "2319467340736213123";
		//$result =  $remoteSignServiceImpl->viewUrl($documentId);
		//print_r($result);
		
		
		//返回值：
		/*Array
		(
			[code] => 0
			[viewUrl] => https://expose.qiyuesuo.me/sign/remote?token=ZmlqZkI0WG15UlB0RFprRkU4NXN2bFZ5MXYxQ2NIZDJDeGYveFJKQ0kvUGxDRUlESHk4NktzaUFFcWhwTEJETw==
			[message] => SUCCESS
			[token] => ZmlqZkI0WG15UlB0RFprRkU4NXN2bFZ5MXYxQ2NIZDJDeGYveFJKQ0kvUGxDRUlESHk4NktzaUFFcWhwTEJETw==
		)*/




		//***********************************************************************6.3  客户测试回调地址是否可用
		$signCallBackUrl = "https://openapi.qiyuesuo.me/remote/contract/callbacktest";//回调地址
		//$result =  $remoteSignServiceImpl->callbackcheckout($signCallBackUrl);
        //print_r($result);
        
        /*失败：
         * Array
		(
		    [code] => 1001
		    [message] => ERROR
		)
		
		成功：
		Array
		(
		    [code] => 0
		    [signCallBackUrl] => 1
		    [message] => SUCCESS
		)
		*
		*/