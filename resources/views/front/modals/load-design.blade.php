<div class="modal fade" id="loadDesignDetails" tabindex="-1" role="dialog" aria-labelle dby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-compare-fabric-header">
                <div class="modal-compare-fabric-title" id="modalTitle">DESIGN DETAILS</div>
                <button type="button" class="close fabric-detail-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-content-cover">
                    <div class="modal-body-content-main">
                        <div class="modal-fabric-detail-cover row">
                            <div class="col-md-6">
                                <div id="modal-design-image-cover">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="modal-design-detail-content">
                                    <div class="modal-design-name">Red Stripe Pure Cotton Long Collar Dress Shirt</div>
                                    <div class="modal-design-price"> MYR 60.00 <span>MYR 102.50</span></div>
                                    <div class="modal-design-description"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s.</div>
                                </div>
                                <form action="{{route('custom-shirt.create')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <input type="hidden" value="" id="productDesign" name="design">
                                    <input type="hidden" value="" id="productFabric" name="fabric">
                                    <div class="modal-pocket-title">Number Of Pockets</div>
                                    <div id="design_pocket" class="row modal-pocket"></div>
                                    <div class="modal-pocket-title">Monograms</div>
                                    <div id="modal-monogram-cover"></div>
                                    <div id="modal-fabric-detail-content-select">
                                        <input type="submit" value="Select Design" class="mob-next-button">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


