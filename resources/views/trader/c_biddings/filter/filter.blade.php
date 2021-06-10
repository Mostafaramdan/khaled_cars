<div class="card-body">
    <form action="{{ route('c_biddings.index') }}" method="get">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <input type="text" placeholder="ابحث هنا"  class="form-control" id="keyword" name="keyword" value="{{old('keyword',request()->input('keyword'))}}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control"  name="order_by" id="order_by">
                        <option value=""     @if (old('order_by', request()->input('order_by')) == '')    SELECTED @endif>ترتيب حسب تواريخ الأنتهاء</option>
                        <option value="asc"   @if (old('order_by', request()->input('order_by')) == 'asc')  SELECTED @endif >تصاعدي</option>
                        <option value="desc"   @if (old('order_by', request()->input('order_by')) == 'desc')  SELECTED @endif >تنازلي</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control"  name="type" id="type">
                        <option value=""     @if (old('type', request()->input('type')) == '')    SELECTED @endif>نوع المزاد</option>
                        <option value="open"   @if (old('type', request()->input('type')) == 'open')  SELECTED @endif >مفتوح</option>
                        <option value="close"   @if (old('type', request()->input('type')) == 'close')  SELECTED @endif >مغلق</option>
                    </select>
                </div>
            </div>
            <div class="col-0">
                <div class="form-group">
                    <select class="form-control"  name="limit_by" id="limit_by">
                        <option value=""     @if (old('limit_by', request()->input('limit_by')) == '')    SELECTED @endif>عدد نتائج الصفحة</option>
                        <option value="25"   @if (old('limit_by', request()->input('limit_by')) == '25')  SELECTED @endif >25</option>
                        <option value="50"   @if (old('limit_by', request()->input('limit_by')) == '50')  SELECTED @endif >50</option>
                        <option value="100"  @if (old('limit_by', request()->input('limit_by')) == '100') SELECTED @endif >100</option>
                        <option value="500"  @if (old('limit_by', request()->input('limit_by')) == '500') SELECTED @endif >500</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">ابحث</button>
                </div>
            </div>
        </div>
    </form>
</div>
