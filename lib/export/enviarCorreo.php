<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$sql="select serial_alu from materiamatriculada where SERIAL_ALu in (2876,
4628,
2990,
6340,
2413,
4519,
3916,
5517,
4350,
4459,
4689,
4113,
3697,
3696,
2777,
4022,
5584,
5167,
4721,
4827,
2636,
4362,
6210,
6157,
3237,
4756,
5393,
5813,
4677,
4028,
4334,
3753,
4426,
5100,
2894,
774,
2530,
5999,
4926,
5663,
892,
3968,
4364,
463,
905,
5231,
4620,
5040,
4920,
3662,
4758,
4462,
4744,
5329,
5538,
4615,
3268,
2945,
2663,
3403,
2191,
3289,
4359,
5241,
5391,
5715,
6193,
5270,
1234,
608,
3571,
5281,
4473,
1021,
5902,
5896,
4045,
3864,
5242,
5274,
5487,
5561,
5717,
5509,
6391,
2960,
2327,
2836,
3962,
4293,
4842,
3741,
450,
5733,
3964,
5893,
2961,
2973,
2776,
5301,
4874,
3642,
2934,
3443,
4675,
6262,
6135,
2620,
5164,
5537,
4019,
4311,
4061,
1001,
474,
5637,
3663,
3929,
4624,
3853,
4444,
4212,
2965,
4626,
6777,
5311,
4916,
4788,
636,
5564,
464,
6653,
3026,
3879,
3352,
537,
2534,
2534,
2195,
3283,
2604,
3873,
3873,
5894,
5282,
2342,
4570,
2947,
5455,
5719,
4887,
382,
6342,
939,
4020,
3912,
3856,
5310,
5289,
5287,
3963,
5992,
2632,
4720,
2752,
850,
3908,
5148,
956,
5738,
6207,
5854,
5254,
3870,
3950,
3863,
4567,
444,
6137,
3666,
5300,
4789,
6771,
6794,
3905,
4859,
3791,
4457,
3276,
4863,
3648,
3374,
5284,
4563,
4051,
4516,
4253,
4935,
4871,
3447,
4449,
915,
2737,
2651,
3222,
6258,
5905,
6770,
3334,
4369,
4102,
397,
4524,
3953,
6343,
4536,
2631,
6181,
5166,
2638,
3382,
2853,
4510,
4165,
5223,
3362,
4353,
4052,
4220,
6375,
3928,
6111,
3009,
3875,
4655,
4023,
3883,
2472,
3341,
3786,
3961,
1231,
3957,
1325,
5153,
6257,
4804,
3445,
3412,
459,
3013,
5617,
4286,
4365,
5633,
4048,
5175,
2745,
5754,
2963,
5569,
5987,
5799,
2490,
5135,
2645,
5536,
4858,
4701,
2739,
5400,
1009,
6280,
5258,
5055,
2977,
1010,
3947,
2609,
5831,
4114,
6038,
2336,
3422,
494,
4770,
3667,
3288,
5741,
5563,
2786,
2844,
4027,
2451,
3660,
4732,
3803,
4817,
506,
3861,
4487,
4712,
5006,
3726,
4340,
536,
2766,
4236,
4735,
2841,
935,
3014,
1834,
6139,
4910,
3787,
3410,
2773,
4554,
3918,
4860,
3291,
4730,
3066,
3855,
6809,
6502,
5173,
5272,
4053,
2981,
4320,
3872,
2484,
3815,
6740,
4890,
887,
4753,
5481,
2246,
1243,
3046,
4818,
6321,
4225,
6789,
4312,
5507,
4251,
1138,
6573,
4637,
2967,
907,
5275,
4569,
5488,
572,
5502,
4862,
4947,
5326,
5108,
2998,
3285,
4848,
4325,
4389,
428,
5888,
4515,
2482,
6110,
4891,
4058,
2442,
3293,
637,
2591,
4508,
5562,
2939,
3932,
6825,
5401,
548,
395,
4632,
4503,
5618,
5103,
4319,
4849,
5649,
2010,
2629,
4530,
2995,
3053,
6286,
4115,
4631,
4719,
2933,
3788,
3448,
2486,
5163,
3965,
785,
4888,
4702,
2895,
5500,
3421,
3184,
628,
2850,
5483,
593,
2685,
4728,
3444,
2601,
3692,
4708,
4851,
4549,
3967,
5403,
4593,
3885,
822,
4338,
3715,
3652,
5903,
4147,
1861,
3559,
2316,
6240,
5146,
3368,
2884,
5097,
2719,
5884,
2634,
6236,
3804,
3896,
826,
5398,
5397,
3921,
3029,
5587,
6156,
4505,
5394,
5105,
3393,
2723,
1008,
3274,
3427,
5642,
1480,
3239,
4372,
3636,
3027,
5285,
5152,
1017,
4509,
4740,
4438,
4614,
2672,
3397,
4648,
5550,
5303,
3015,
4465,
4838,
5322,
3017,
4828,
2457,
3659,
3922,
5472,
4324,
2710,
2650,
3955,
3956,
5426,
2940,
3568,
4021,
6544,
5460,
4699,
5567,
3032,
738,
5169,
2707,
4612,
2875,
3570,
3941,
4845,
5160,
4084,
2826,
4660,
4806,
1873,
3790,
562,
5512,
5518,
5565,
4081,
5528,
4351,
2697,
6219,
3345,
4529,
5816,
4815,
2183,
4553,
535,
5238,
4540,
5315,
5137,
4575,
2705,
4711,
4496,
4793,
5703,
5811,
3371,
4476,
2903,
5521,
6165,
5556,
446,
4754,
3281,
3973,
422,
4492,
4344,
3823,
3266,
4140,
4140,
3040,
451,
2071,
4531,
5601,
3287,
1002,
5840,
5044,
6569,
3712,
2738,
5154,
3294,
2192,
797,
1229,
5151,
630,
5845,
792,
2959,
4059,
5599,
5511,
4921,
4856,
2681,
477,
4737,
3004,
2834,
884,
5312,
5824,
4043,
6843,
4106,
3917,
3924,
2806,
4342,
4726,
4525,
2683,
3381,
4124,
3884,
3446,
2187,
2187,
3668,
4317,
4329,
5600,
6805,
926,
2608,
5236,
2535,
2809,
6212,
2659,
4878,
5566,
2234,
2789,
1237,
5570,
2468,
3301,
3858,
441,
6194,
4692,
2944,
5052,
5235,
1137,
3493,
4358,
4341,
4725,
6285,
4287,
6348,
3891,
471,
5805,
3057,
2444,
4469,
4217,
2590,
4700,
2812,
2186,
4393,
603,
5632,
4714,
3377,
3869,
2189,
4029,
504,
6151,
5851,
821,
5261,
6671,
3305,
936,
2889,
4594,
617,
5468,
4077,
6018,
4280,
5102,
5114,
6261,
4511,
4082,
4873,
3408,
2412,
3409,
4456,
6203,
6182,
5291,
4785,
4875,
5800,
1011,
5475,
3809,
5535,
5883,
2605,
775,
3800,
3384,
2762,
3060,
3269,
3051,
3439,
4922,
2185,
435,
2901,
3022,
3888,
3776,
2997,
818,
3404,
2952,
2999,
4363,
2470,
5650,
4219,
5458,
6675,
5473,
5627,
2819,
4348,
5224,
2900,
3691,
5880,
3355,
3002,
4545,
3868,
6216,
4619,
5527,
2741,
3895,
3649,
2968,
2840,
809,
571,
411,
3871,
5243,
2849,
3867,
3450,
3716,
2846,
3943,
2832,
3898,
3937,
3398,
6758,
4074,
6140,
4467,
4392,
5233,
3958,
5659,
5278,
4436,
4127,
4431,
3061,
6561,
6647,
6224,
2874,
912,
3064,
4880,
3902,
5529,
3383,
3933,
3010,
4218,
4546,
2662,
3038,
4680,
3793,
4627,
6346,
4724,
5162,
5605,
4047,
3296,
4125,
2624,
384,
2467,
5523,
5612,
2708,
473,
4026,
5417,
6113,
3894,
3664,
5396,
854,
4562,
3665,
4834,
4475,
5222,
2330,
3913,
4464,
6019,
2333,
3286,
6753,
3346,
6130,
4668,
4881,
5552,
3354,
434,
2250,
5595,
4433,
4432,
4488,
4869,
3960,
4949,
4207,
4541,
5414,
5568,
6256,
6396,
3848,
2485,
6746,
2974,
5710,
2649,
3295,
3693,
3906,
4041,
3228,
2893,
4930,
1006,
5591,
3369,
6233,
4573,
4784,
5147,
3278,
4683,
4109,
6187,
6243,
4032,
4659,
6195,
3951,
1022,
2641,
2524,
921,
2797,
2728,
4323,
5585,
5692,
5555,
523,
4356,
5165,
2520,
4924,
4810,
4450,
4883,
4801,
4485,
5395,
4797,
430,
466,
5574,
795,
908,
4209,
5631,
5668,
383,
6664,
6667,
6114,
3050,
2597,
3277,
2459,
2936,
5056,
2830,
6192,
5670,
3724,
4931,
3350,
3866,
2941,
4333,
4526,
2962,
5418,
3723,
4025,
2971,
3373,
4809,
432,
4550,
4866,
3695,
4493,
4085,
2325,
4706,
4347,
5239,
6822,
2802,
4502,
4652,
4443,
2666,
2424,
4940,
513,
4451,
5263,
5240,
4876,
5817,
6513,
4495,
4571,
5427,
6759,
2949,
3903,
6186,
2949,
2932,
4651,
3647,
4879,
3375,
498,
3865,
5908,
2628,
3920,
2782,
2852,
4447,
5638,
3857,
5402,
2902,
3974,
2747,
2418,
2878,
5214,
4054,
3923,
3901,
3910,
3854,
3854,
4224,
5652,
6685,
5321,
3455,
5718,
4826,
6191,
5885,
5904,
3003,
3881,
5228,
661,
5850,
6253,
4990,
396,
3279,
5266,
3979,
4831,
2896,
3438,
4846,
3349,
2196,
6034,
4458,
3275,
2637,
4237,
4705,
4843,
2730,
5288,
3656,
4243,
4537,
3889,
3360,
3939,
4314,
3719,
4024,
3725,
4928,
3449,
3453,
4497,
3981,
4832,
888,
5264,
5448,
6386,
4807,
4226,
4945,
891,
2922,
925,
4346,
3021,
3911,
6153,
4882,
5513,
5626,
5639,
5794,
5581,
6209,
2899,
6005,
5467,
4208,
4208,
4738,
5640,
2419,
5582,
4322,
3877,
4936,
4123,
5815,
6344,
3290,
2600,
4494,
3337,
3767,
5316,
5575,
5643,
2983,
5666,
2897,
6040,
5571,
2598,
2975,
5583,
4507,
6196,
6775,
6552,
861,
3270,
3882,
5405,
5046,
6389,
5390,
3876,
5250,
875,
455,
4427,
3063,
410,
2910,
2355,
3980,
5586,
3435,
4424,
5234,
5897,
747,
5449,
5658,
4518,
4727,
3396,
6339,
4360,
5593,
4417,
4825,
4087,
5647,
4248,
878,
5696,
380,
5695,
3948,
4117,
6252,
6766,
4742,
870,
2757,
2353,
3395,
4551,
4440,
4430,
1230,
3919,
2717,
3977,
4094,
1014,
903,
4535,
5579,
3945,
4452,
6108,
1139,
5526,
5838,
4460,
2831,
4343,

5136,
2746,
3717,
2906,
4829,
4512,
880,
5655,
6742,
4743,
2979,
6239,
4071,
4674,
621,
1003,
3574,
4506,
5155,
4357,
6390,
6499,
2788,
3235,
420,
4434,
5689,
4233,
4748,
4857,
5313,
4601,
6213,
6353,
5664,
3738,
3006,
4527,
3023,
3273,
3306,
4694,
439,
5823,
3394,
4667,
2435,
4368,
1222,
5644,
5297,
3221,
4574,
4371,
4647,
467,
928,
4787,
4716,
1228,
3271,
3020,
2838,
5225,
525,
4644,
4112,
4534,
3959,
3039,
5616,
6797,
4222,
5597,
923,
3841,
3035,
3018,
2827,
4723,
2761,
3909,
4044,
5654,
4254,
6283,
2793,
4592,
5252,
2571,
4805,
3818,
5879,
5042,
5546,
3034,
4210,
3935,
5478,
6769,
6774,
3880,
5237,
6190,
5515,
3641,
2805,
924,
4877,
6370,
2813,
4820,
4609,
2276,
660,
4968,
5522,
4914,
4215,
3915,
6748,
3892,
4953,
5260,
4606,
2274,
4214,
6743,
2988,
4249,
6844,
3567,
5532,
2351,
5459,
3944,
3400,
3795,
574,
2822,
5559,
3340,
4441,
5150,
3353,
4696,
5424,
585,
2756,
2589,
5392,
5611,
3343,
4670,
5304,
4893,
4558,
3900,
5842,
902,
5465,
5314,
4951,
2603,
6273,
4126,
2464,
2758,
3969,
5907,
3733,
3379,
2415,
2931,
5906,
4833,
2750,
1005,
1236,
2625,
5251,
4223,
2458,
4089,
3794,
3336,
2630,
4836,
5248,
3054,
3744,
2420,
377,
6780,
501,
5267,
3043,
5232,
448,
2980,
2726,
3904,
6571,
4337,
2994,
2798,
3661,
4445,
5534,
5050,
5245,
2987,
4474,
612,
3065,
979,
4625,
6850,
5589,
3637,
6164,
3103,
5882,
3451,
6739,
4522,
5456,
5690,
5843,
6248,
5818,
5819,
5833,
1235,
896,
5525,
6665,
4448,
6020,
2190,
4895,
2908,
5505,
3893,
5635,
3874,
2232,
470,
2976,
2639,
4439,
2347,
2606,
4042,
2709,
5736,
5482,
2698,
4733,
2715,
5734,
5725,
3036,
3265,
3755,
3062,
3351,
4030,
4707,
5886,
423,
5477,
4354,
3970,
4941,
4049,
4671,
2668,
4841,
5560,
475,
3799,
2526,
755,
2821,
5290,
4715,
5450,
3798,
1406,
6829,
4598,
2696,
1224,
4792,
2522,
2275,
2690,
4335,
3312,
954,
6166,
4605,
3089,
4861,
4288,
2194,
4321,
2462,
4520,
4046,
6839,
4731,
6838,
3284,
4498,
3012,
2635,
3705,
3639,
2642,
2448,
573,
4390,
3376,
2969,
4932,
4676,
3401,
5629,
5520,
5308,
5319,
4795,
4566,
3734,
3907,
2951,
5280,
4355,
5657,
2704,
3694,
4835,
3654,
6104,
5331,
5247,
3860,
2531,
2082,
3282,
4915,
5268,
3942,
5253,
3966,
5508,
2930,
4597,
6830,
6394,
6105,
4332,
4437,
638,
6033,
4446,
5330,
4703,
2905,
4913,
3714,
2881,
5554,
6341,
5573,
5172,
5828,
5625,
5259,
752,
5265,
2452,
6347,
2623,
3067,
3365,
3983,
5168,
3971,
5651,
3363,
6579,
4641,
3954,
4216,
589,
3757,
2453,
2653,
5262,
5249,
4886,
5645,
759,
3806,
6177,
3821,
5545,
5302,
3575,
2842,
4111,
6227,
6545,
5576,
4521,
3843,
4823,
5255,
4736,
5613,
6255,
5170,
4478,
6208,
3405,
3055,
5332,
5389,
4556,
478,
5648,
2803,
4327,
6060,
6501,
784,
6831,
3049,
2904,
6242,
4662,
3862,
1233,
6138,
4491,
3763,
773,
952,
3914,
5158,
4867,
3762,
5171,
4837,
4455,
4453,
6648,
418,
4751,
4211,
6183,
885,
4855,
5246,
6168,
3746,
4717,
2676,
788,
6582,
4604,
393,
3785,
4713,
4454,
3292,
2775,
6073,
2588,
3651,
6011,
4664,
5881,
4759,
2525,
6755,
5656,
6652

) group by SERIAL_ALU";
$arrAlu1 = $dblink->GetAll($sql);
$totAll = count($arrAlu1);
//echo $sql;
?>
<table>
<tr><td>N� credito S/HyR</td><td>serial_Alu</td><td>N� creditos+ H,R,E</td></tr>
<?
for($i=0;$i<$totAll;$i++){
		
$arr= devolverCred($arrAlu1[$i]['serial_alu'],$dblink);
$arr1= devolverhom($arrAlu1[$i]['serial_alu'],$dblink);
?>
<tr><td>
<?
//echo $arr1;
$var=$arr1+$arr[0]['total'];
echo "<br>". $arr[0]['total']." <td>".$arrAlu1[$i]['serial_alu']."<td>".$var;

//echo $arr1;
?>
</tr>

<?	
//echo "<br>".$arrAlu['total'];		
}	
?>
</table>
<?

function devolverCred($serial_alu,$dblink){


$ql1="SELECT distinct(dma.serial_mat),
    sum(dma.numerocreditos_dma) total
FROM
    alumnomalla ama,
    malla maa,
    detallemalla dma 
WHERE
    serial_alu=".$serial_alu." 
    AND maa.serial_maa=ama.serial_maa 
    AND dma.serial_maa=maa.serial_maa 
    AND dma.serial_mat IN ( SELECT dmat.serial_mat 
                            FROM
                                materiamatriculada mmat,
                                detallemateriamatriculada dmat,
                                notasalumnos nal,
                                periodo per,
                                horario HRR 
                            WHERE
                                mmat.SERIAL_PER=per.serial_per 
                                AND mmat.SERIAL_MMAT=dmat.serial_mmat 
                                AND dmat.serial_dmat=nal.serial_dmat 
                                AND mmat.SERIAL_ALU=".$serial_alu." 
                                AND dmat.retiromateria_dmat='' 
                                AND nal.estado_nal like 'APRUEBA' 
                                AND hrr.SERIAL_HRR=dmat.serial_hrr
    ) group by serial_alu";

if($arr = $dblink->GetAll($ql1)){		
		//$arrhom = $dblink->GetAll($sql);
		
		return $arr;
	}else{
		return false;
	}
	}
	
function devolverhom($serial_alu,$dblink)
	{
	
	$sqlHom = "
	sELECT   DISTINCT(dma.serial_mat),
    dma.numerocreditos_dma,ama.serial_alu 
FROM
    alumnomalla ama,
    malla maa,
    detallemalla dma 
WHERE
    serial_alu=".$serial_alu."
    AND maa.serial_maa=ama.serial_maa 
    AND dma.serial_maa=maa.serial_maa 
    AND dma.serial_mat IN (SELECT
    
    dhom.serial_mat
    
FROM
    homologacion        AS hom,
    detallehomologacion AS dhom,
    materia             AS mat,
    periodo             AS per 
WHERE
    hom.serial_hom = dhom.serial_hom 
    AND mat.serial_mat = dhom.serial_mat 
    AND per.serial_per=hom.serial_per 
    AND hom.serial_alu = ".$serial_alu."

and (tipo_hom='HOMOLOGACION'OR tipo_hom='revalidacion' or'EXAMENAVANZADO'))"
		
;
	//echo $sqlHom;
if($arr1 = $dblink->GetAll($sqlHom)){		
		$totAll = count($arr1);
		$cont=0;
		for($i=0;$i<$totAll;$i++){
		$cont=$cont+$arr1[$i]['numerocreditos_dma'];
		}
		//echo $cont;
		return $cont;
	}else{
		return 0;
	}
	
	}

?>