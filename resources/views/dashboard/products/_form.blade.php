@csrf
<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <x-form.input name="name" :value="$product->name" lable="Product Name" />
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid   @enderror">
                <option value="">Select One</option>
                @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category_id', $product->category_id)) selected @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        {{-- textarea.blade --}}

        <div class="form-group mb-3">
            <x-form.textarea lable="Description" name="description" :value="$product->description" />
        </div>

        {{-- here down --}}
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input type="number" name="price" value="{{ $product->price }}" lable="Price"
                        placeholder="price" />
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input type="number" name="compare_price" value="{{ $product->compare_price }}"
                        lable="Compare Price" />
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input type="number" name="cost" value="{{ $product->cost }}" lable="Cost" />
                </div>
            </div>


            <div class="form-row">


                <div class="form-group mb-3">
                    <label for="sku">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                        class="form-control @error('sku') is-invalid @enderror">
                    @error('sku')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="barcode">BarCode</label>
                        <input type="text" name="barcode" id="barcode"
                            value="{{ old('barcode', $product->barcode) }}"
                            class="form-control @error('barcode') is-invalid   @enderror">
                        @error('barcode')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity"
                            value="{{ old('quantity', $product->quantity) }}"
                            class="form-control @error('quantity') is-invalid   @enderror">
                        @error('quantity')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="availabillty">Availabillty</label>
                        <select name="availabillty" id="availabillty"
                            class="form-control @error('availabillty') is-invalid   @enderror">
                            <option value="">Select One</option>
                            @foreach ($availabillties as $key => $availabillty)
                                <option value="{{ $key }}" @if ($key == old('availabillty', $product->availabillty)) selected @endif>
                                    {{ $availabillty }}</option>
                            @endforeach
                        </select>
                        @error('availabillty')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-6">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid   @enderror">
                <option value="">Select One</option>
                @foreach ($status_options as $key => $status)
                    <option value="{{ $key }}" @if ($key == old('status', $product->status)) selected @endif>
                        {{ $status }}</option>
                @endforeach
            </select>
            @error('status')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror

        </div>

        <div class="col-md-4">
            <div class="form-group mb-3">


                <div class="form-group mb-6" >
                    <label for="tags">Tags</label>
                    <x-form.textarea name="tags" />
                </div>

                <div class="mb-2">
                    <img id="thumbnail" src="{{ $product->image_url }}" height="150">
                </div>

                <label for="image">Thumbnail</label>
                <input type="file" name="image" style="display: none"
                    id="image"class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>


        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-danger ml-2">{{ $button2 }}</a>
        </div>

    </div>
</div>
