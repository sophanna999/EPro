@extends('email.template')
@section('body')

<!-- Banner Start -->
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
	<tr>
		<td>
			<table bgcolor="#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
				<tr>
					<td>
						<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
							<tr>
								<td>
									<!-- Space -->
									<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
										<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
									</table>
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
										<tr>
											<td>
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
													<tr>
														<td width="100%" align="left" style="font-size: 28px; line-height: 34px; font-family:helvetica, Arial, sans-serif; font-weight: bold; color:#343434;">
															You are successfull
															Email {{$input['merchant']}} <br>
															Referrence ID {{$input['ref_id']}} <br>
															Total Amount {{$input['total_amount']}} 
														</td>
													</tr>
												</table>
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="75%" style="border-collapse: collapse;">
													<!-- Space -->
													<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
													<tr>
														<td width="100%" align="left" style="font-size: 15px; line-height: 22px; font-family:helvetica, Arial, sans-serif; color:#666666;">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit. Abinas aut vitae tempore similique cupiditate, atque ad reiciendis asperiores maiores dolores necessit...
														</td>
													</tr>
												</table>
												<table align="right" border="0" cellpadding="0" cellspacing="0" width="22%" style="border-collapse: collapse;">
													<!-- Space -->
													<tr><td style="font-size: 0; line-height: 0;" height="25">&nbsp;</td></tr>
													<tr>
														<td width="100%" align="center" style="padding:10px 12px 10px 12px; text-align: center;" bgcolor="#db7093">
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- Space -->
									<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
										<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- Banner End -->
@endsection