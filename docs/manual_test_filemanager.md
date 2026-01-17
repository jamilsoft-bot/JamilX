# Manual Test Plan — File Manager Service

## Pre-req
- Ensure you are logged in (if `filemanager_config()['requires_login']` is true).
- Visit `/filemanager` (or `/filemanger` alias) to open the UI.

## Browser/UI
1. **Browse root**
   - Visit `/filemanager` and confirm the root listing renders.

2. **Switch scopes**
   - Use the scope switcher to move between Public and Private.
   - Confirm the path resets to root and listings update.

3. **Create folder**
   - Enter a folder name in the “New Folder” field and click **Create**.
   - Confirm folder appears in the list.

4. **Upload**
   - Use the upload input to add one or more files.
   - Confirm file(s) appear in the list.

5. **Rename**
   - Use the Rename action on a file or folder.
   - Confirm name updates in the listing.

6. **Move**
   - Use the Move action with a target path (e.g. `archives` or `archives/example.txt`).
   - Confirm the item appears in the target location.

7. **Copy**
   - Use the Copy action with a target path.
   - Confirm a duplicate exists in the target location.

8. **Delete**
   - Use the Delete action and accept the confirmation prompt.
   - Confirm item is removed.

9. **Download**
   - Use the Download action on a file.
   - Confirm the file downloads.

10. **Preview**
    - Use Preview for image/PDF files.
    - Confirm the file opens in a new tab.

11. **Search**
    - Search for a filename substring.
    - Confirm results display and the Clear link returns to browse.

12. **Sort/Pagination**
    - Click column headers to sort by name/type/size/date.
    - If enough files exist, verify pagination links work.

## API (Optional)
1. **List**
   - `GET /filemanager/api/list?scope=public&path=`
   - Confirm JSON response with entries and pagination.

2. **Upload**
   - `POST /filemanager/api/upload?scope=public&path=` with multipart `files[]`.
   - Confirm JSON response indicating upload results.
