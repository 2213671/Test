package com.example.pos_hcsdl.config;

import io.swagger.v3.oas.annotations.OpenAPIDefinition;
import io.swagger.v3.oas.annotations.tags.Tag;
import io.swagger.v3.oas.models.Components;
import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.info.Info;
import io.swagger.v3.oas.models.security.SecurityRequirement;
import io.swagger.v3.oas.models.security.SecurityScheme;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

@Configuration
@OpenAPIDefinition(
    tags = {
            @Tag(name = "1. Auth Management", description = "Quản lý Auth"),
            @Tag(name = "2. Restaurant Management", description = "Quản lý nhà hàng"),
            @Tag(name = "3. Table Management", description = "Quản lý bàn"),
            @Tag(name = "4. Menu Management", description = "Quản lý thực đơn"),
            @Tag(name = "5. Topping Management", description = "Quản lý topping"),
            @Tag(name = "6. Option Management", description = "Quản lý option"),
            @Tag(name = "7. Product Management", description = "Quản lý sản phẩm"),
            @Tag(name = "8. Promotion Management", description = "Quản lý khuyến mãi"),
            @Tag(name = "9. Payment Method Management", description = "Quản lý phương thức thanh toán"),
            @Tag(name = "10. Shift Management", description = "Quản lý ca"),
            @Tag(name = "11. Order Management", description = "Quản lý đơn hàng"),
            @Tag(name = "12. Order History Management", description = "Quản lý lịch sử order")
    }
)
public class OpenApiConfig {

    @Bean
    public OpenAPI choQueSoOpenAPI() {
        return new OpenAPI()
                .info(new Info()
                        .title("------- API")
                        .description("---------")
                        .version("1.0.0"))
                .components(new Components()
                        .addSecuritySchemes("bearer-key",
                                new SecurityScheme()
                                        .type(SecurityScheme.Type.HTTP)
                                        .scheme("bearer")
                                        .bearerFormat("JWT")
                        )
                )
                .addSecurityItem(new SecurityRequirement().addList("bearer-key"));

    }
}
