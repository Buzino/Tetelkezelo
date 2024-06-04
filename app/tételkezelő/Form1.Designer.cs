namespace tételkezelő
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.tetelekDGV = new System.Windows.Forms.DataGridView();
            ((System.ComponentModel.ISupportInitialize)(this.tetelekDGV)).BeginInit();
            this.SuspendLayout();
            // 
            // tetelekDGV
            // 
            this.tetelekDGV.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.tetelekDGV.EditMode = System.Windows.Forms.DataGridViewEditMode.EditOnEnter;
            this.tetelekDGV.Location = new System.Drawing.Point(73, 61);
            this.tetelekDGV.Name = "tetelekDGV";
            this.tetelekDGV.Size = new System.Drawing.Size(821, 506);
            this.tetelekDGV.TabIndex = 0;
            this.tetelekDGV.CellValueChanged += new System.Windows.Forms.DataGridViewCellEventHandler((_sender, _e) => { tetelekDGVchanged(); });
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1022, 622);
            this.Controls.Add(this.tetelekDGV);
            this.Name = "Form1";
            this.Text = "Tetelkezelo";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.tetelekDGV)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGridView tetelekDGV;
    }
}

