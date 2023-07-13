<div class="card col-12">
    <div class="my-3">
      <form novalidate class="ng-untouched ng-pristine ng-invalid">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="email" class="form-label">البريد الإلكتروني : </label>
            <input formcontrolname="Email" id="email" type="email" class="form-control ng-untouched ng-pristine ng-invalid">
          </div>
          <div class="col-md-6 mb-3">
            <label for="password" class="form-label">كلمة السر : </label>
            <input formcontrolname="Password" id="password" type="password" class="form-control ng-untouched ng-pristine ng-invalid">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="name" class="form-label">اسم المدرب : </label>
            <input formcontrolname="CoachName" id="name" type="text" class="form-control ng-untouched ng-pristine ng-invalid">
          </div>
          <div class="col-md-6 mb-3">
            <label for="subcategory" class="form-label">التصنيف الفرعي : </label>
            <select formcontrolname="SubCategoryId" name="subcategory" id="subcategory" class="form-control ng-untouched ng-pristine ng-invalid">
              <option value="7"> لياقة بندية </option>
              <option value="8"> كمال أجسام </option>
              <option value="9"> رسم </option>
              <option value="10"> نحت </option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="image" class="form-label">صورة المدرب : </label>
            <input formcontrolname="Image" id="image" type="file" accept="image/png, image/jpeg" class="form-control ng-untouched ng-pristine ng-invalid">
          </div>
          <div class="col-md-6 mb-3">
            <label for="dateOfBirth" class="form-label">تاريخ الميلاد : </label>
            <input formcontrolname="dateOfBirth" id="dateOfBirth" type="date" class="form-control ng-untouched ng-pristine ng-invalid">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Phone" class="form-label">رقم المدرب : </label>
          <input formcontrolname="PhoneNumber" id="Phone" type="tel" class="form-control ng-untouched ng-pristine ng-invalid">
        </div>
        <div class="col-md-6 mb-3">
          <button class="btn btn-outline-success">إضافة</button>
        </div>
      </form>
    </div>
  </div>