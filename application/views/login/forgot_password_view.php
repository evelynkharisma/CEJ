<div class="login-box-choose">
    <div class="login-box-header">
        Forgot Password
    </div>
    <div class="login-box-content-choose">
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open('login/forgot_password'); ?>
        <select name="loginas"">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="parent">Parent</option>
            <option value="operation">Operation</option>
            <option value="admini">Administrator</option>
        </select>
        <input type="email" placeholder="Email" name="email"> <br>
    </div>
    <div class="login-box-footer" style="text-align: right">
        <table>
            <tr>
                <td align="left">
                    <a href="<?php echo base_url() ?>index.php/login" class="forgot-password">Back To Login Page</a>
                </td>
                <td align="right">
                    <button class="btn login-btn" type="submit"></button> <br>
                </td>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>