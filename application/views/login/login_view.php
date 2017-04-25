<div class="login-box-choose">
    <div class="login-box-header">
        Login
    </div>
    <div class="login-box-content-choose">
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open('login/index'); ?>
        <select name="loginas">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="parent">Parent</option>
            <option value="operation">Operation</option>
            <option value="admin">Administrator</option>
        </select>
        <input type="text" placeholder="Username" name="username"> <br>
        <input type="password" placeholder="Password" name="password"> <br>
    </div>
    <div class="login-box-footer">
        <table>
            <tr>
                <td align="left">
                    <a href="<?php echo base_url() ?>index.php/login/forgot_password" class="forgot-password">Forgot Password?</a>
                </td>
                <td align="right">
                    <button class="btn login-btn" type="submit"></button> <br>
                </td>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>