<div class="rounded-md bg-white">
    <div class="border-b p-3 flex justify-between">
        <h3>Publish</h3>
    </div>
    <div class="px-3 py-6">
        <input type="hidden" name="submit" value="">
        <button
            onclick="this.form.submit.value=this.value"
            type="submit"
            value="save"
            class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
            Save
        </button>
        <button
            onclick="this.form.submit.value=this.value"
            type="submit"
            value="saveAndEdit"
            class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-600 hover:bg-green-700 hover:shadow-lg">
            Save & Edit
        </button>

    </div>
</div>
