<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{$type}}</h5>
    <button type="button" class="close btn btn-danger"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ($type == 'google')
        <div class="edit_integration_box">
            <div class="next_integration_box">
                <img class="MuiCardMedia-root MuiCardMedia-media MuiCardMedia-img jss70 css-rhsghg" src="{{asset('frontend/images/google.png')}}">
                <div class="MuiBox-root css-12z0wuy"></div>
                <div class="edit_integration_company_name" weight="6" aria-label="{{$Integration->name ?? ''}}" has_text="true">
                    <h6>{{$Integration->name ?? 'Google Integration'}}</h6>
                </div>
                <div class="MuiBox-root css-12z0wuy"></div>
                @if(isset($Integration) && !empty($Integration->review_links))
                <button class="redirect_button" tabindex="0" type="button" title="View Review Link">
                    <div class="undefined font_600 TextNode MuiBox-root css-1flyc9m" size="18">
                        <a href="{{$Integration->review_links}}" target="_blank">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true">
                                <path d="M8.48579 2.35259C9.64151 2.08149 10.8207 1.94595 12 1.94595C12.5374 1.94595 12.973 1.51033 12.973 0.972973C12.973 0.435615 12.5374 0 12 0C10.6716 0 9.34326 0.152689 8.0414 0.458065C4.27866 1.34068 1.34069 4.27866 0.458066 8.04139C-0.152689 10.6451 -0.152689 13.3549 0.458066 15.9586C1.34069 19.7213 4.27866 22.6593 8.0414 23.5419C10.6451 24.1527 13.3549 24.1527 15.9586 23.5419C19.7213 22.6593 22.6593 19.7213 23.5419 15.9586C23.8473 14.6567 24 13.3283 24 12C24 11.4626 23.5644 11.027 23.027 11.027C22.4897 11.027 22.0541 11.4626 22.0541 12C22.0541 13.1792 21.9185 14.3585 21.6474 15.5142C20.9336 18.5574 18.5574 20.9336 15.5142 21.6474C13.2028 22.1896 10.7972 22.1896 8.48579 21.6474C5.44259 20.9336 3.06643 18.5574 2.35259 15.5142C1.8104 13.2028 1.8104 10.7972 2.35259 8.48579C3.06643 5.44258 5.44259 3.06643 8.48579 2.35259Z" fill="black"></path>
                                <path d="M17.8378 0C17.3005 0 16.8649 0.435615 16.8649 0.972973C16.8649 1.51033 17.3005 1.94595 17.8378 1.94595H20.6781L14.5552 8.06876C14.1753 8.44873 14.1753 9.06478 14.5552 9.44475C14.9352 9.82472 15.5513 9.82472 15.9312 9.44475L22.0541 3.32194V6.16216C22.0541 6.69952 22.4897 7.13513 23.027 7.13513C23.5644 7.13513 24 6.69952 24 6.16216V0.972973C24 0.435615 23.5644 0 23.027 0H17.8378Z" fill="black"></path>
                           </svg> 
                        </a>
                    </div>
                </button>
                @endif
            </div>

            <form id="google_status_form" class="mt-3">
                @csrf
                <input type="hidden" name="id" value="{{$Integration->id}}">
                <input type="hidden" name="review_type" value="google">
                <div class="form-group row align-items-center mb-3">
                    <label for="google_status_select" class="col-3 text-end control-label col-form-label">Status</label>
                    <div class="col-9 border-start pb-2 pt-2">
                        <select name="status" id="google_status_select" class="form-control" required>
                            <option value="active" @if(isset($Integration) && ($Integration->status == 'active' || empty($Integration->status))) selected @endif>Active</option>
                            <option value="inactive" @if(isset($Integration) && $Integration->status == 'inactive') selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-info rounded-pill px-4 waves-effect waves-light" onclick="save_google_status()">
                        Save Status
                    </button>
                </div>
            </form>

            <div class="disconnect_box my-4 pt-3 border-top">
                <div class="next_disconnect_box">
                    <div class="left_disconnect_button_box">
                        <button class="btn btn-dark rounded-pill px-4" data-bs-dismiss="modal" aria-label="Close" type="button" onclick="hide_modal()">
                            Close
                        </button>
                    </div>
                    <div class="right_disconnect_button_box">
                        <button class="btn btn-danger" tabindex="0" type="button" onclick="disconect_integration('{{$type}}')">
                            <div class="undefined font_600 TextNode MuiBox-root css-1kuy7z7" weight="6" size="14">Disconnect</div>
                            <span class="MuiTouchRipple-root css-w0pj6f"></span>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    @else
        
    @endif
</div>