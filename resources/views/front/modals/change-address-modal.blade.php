    <div class="modal fade" id="changeAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-compare-fabric-header">
            <div class="modal-compare-fabric-title" id="modalTitle">Select Address</div>
          </div>
          <div class="modal-body" id="modalBody">
            <div class="modal-address-list-cover">
                    <table class="table" id="spc-add-table">
                        <thead class="thead-dark add-tab-head">
                            <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Label</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="spc-add-tab-body">
                                <th><div class="add-tab-name">{{$billing_address->name}}</div></th>
                                <td>{{$billing_address->address}},{{$billing_address->city}}, {{$billing_address->postcode}}, {{$billing_address->zone->country->name}}.</td>
                                <td>{{$billing_address->phoneCode->value}}{{$billing_address->phone}}</td>
                                <td><span class="badge badge-light">Billing Address</span></td>
                                <td><div class="spc-add-tab-action"><input type="radio" name="billing_address"></div></td>
                            </tr>
                            <tr class="spc-add-tab-body">
                                <th><div class="add-tab-name">{{$shipping_address->name}}</div></th>
                                <td>{{$shipping_address->address}},{{$shipping_address->city}}, {{$shipping_address->postcode}}, {{$shipping_address->zone->country->name}}.</td>
                                <td>{{$shipping_address->phoneCode->value}}{{$shipping_address->phone}}</td>
                                <td><span class="badge badge-light">Billing Address</span></td>
                                <td><div class="spc-add-tab-action"><input type="radio" name="billing_address"></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
      </div>
    </div>

{{-- <tr class="spc-add-tab-body">
<th><div class="add-tab-name">+ 'address.name' +</div></th>
<td>+'address.address'+</td>
<td>+'address.phone'+</td>
<td><span class="badge badge-light">+'address.label'+</span></td>
<td><div class="spc-add-tab-action"><input type="radio" name="address" value="+'address.label'+"></div></td>
</tr>

<tr class="spc-add-tab-body"><th><div class="add-tab-name">+ 'address.name' +</div></th><td>+'address.address'+</td><td>+'address.phone'+</td><td><span class="badge badge-light">+'address.label'+</span></td><td><div class="spc-add-tab-action"><input type="radio" name="address" value="+'address.label'+"></div></td></tr> --}}