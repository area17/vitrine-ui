import { createBehavior } from '@area17/a17-behaviors'

const FileUpload = createBehavior(
    'FileUpload',
    {
        _hoveredState() {
            this.$node.classList.add('is-dragged-over')
            this.$node.classList.add('opacity-60')
        },

        _cleanState() {
            this.$node.classList.remove('is-dragged-over')
            this.$node.classList.remove('opacity-60')
        },

        _handleDragOver(e) {
            e.preventDefault()
            this.isDragging = true
            this._hoveredState()
        },

        _handleDragLeave(e) {
            e.preventDefault()
            this.isDragging = false
            this._cleanState()
        },

        _handleDrop(e) {
            e.preventDefault()
            this._cleanState()
            const files = e.dataTransfer.files
            this._handleFiles(files)
        },

        _handleInputChange() {
            const files = this.$input.files
            this._handleFiles(files)
        },

        _handleFiles(files) {
            this.hasError = false
            if (files.length === 1) {
                const file = files[0]
                const fileSize = file.size / 1024 / 1024 // in MiB

                if (fileSize > this.maxFileSize) {
                    this.hasError = true
                    this.uploadedFile = null
                    this.isDragging = false

                    this._updateUI(file)

                    return false
                }

                this._updateUI(file)
            }
        },

        _updateUI(file) {
            // show selected state
            this.$selected.classList.remove('hidden')
            if (this.hasError) {
                this.$successIcon.classList.add('hidden')
                this.$errorIcon.classList.remove('hidden')
            } else {
                this.$successIcon.classList.remove('hidden')
                this.$errorIcon.classList.add('hidden')
            }

            // hide drop state
            this.$drop.classList.add('hidden')

            this.$selectedName.textContent = file.name
        },

        _resetInput() {
            this.$selectedName.textContent = ''
            this.$input.value = null
            this.$selected.classList.add('hidden')
            this.$drop.classList.remove('hidden')
        }
    },
    {
        init() {
            // elems
            this.$input = this.getChild('input')
            this.$drop = this.getChild('drop')
            this.$selected = this.getChild('selected')
            this.$selectedIconError = this.getChild('selected-icon-error')
            this.$selectedIconCheck = this.getChild('selected-icon-check')
            this.$selectedName = this.getChild('selected-name')
            this.$selectedRemove = this.$selected.querySelector('button')
            this.$successIcon = this.getChild('successicon')
            this.$errorIcon = this.getChild('erroricon')

            // state
            this.isDragging = false
            this.maxFileSize = this.options.size
            this.allowedFiles = this.$input.accept
            this.uploadedFile = false

            this.$selectedRemove.addEventListener(
                'click',
                this._resetInput,
                false
            )
            this.$input.addEventListener('change', this._handleInputChange)
            this.$drop.addEventListener('dragover', this._handleDragOver, false)
            this.$drop.addEventListener(
                'dragleave',
                this._handleDragLeave,
                false
            )
            this.$drop.addEventListener('drop', this._handleDrop, false)
            this.getChild('btn').addEventListener('click', () => {
                this.$input.click()
            })
        },
        destroy() {
            this.$input.removeEventListener('change', this._handleInputChange)
            this.$drop.removeEventListener('dragover', this._handleDragOver)
            this.$drop.removeEventListener('dragleave', this._handleDragLeave)
            this.$drop.removeEventListener('drop', this._handleDrop)
        }
    }
)

export default FileUpload
