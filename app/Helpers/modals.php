<?php
function myModal($nama, $type)
{
    $t = null;
    $t .= '
    <div class="modal fade" id="' . $nama . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog ' . $type . ' modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered Modal</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ' . $nama . '-body"></div>
                
            </div>
        </div>
    </div>
    ';

    return $t;
}
