DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GESTIONAR_AREAS_VINCULACION`(
	-- Descripción: Gestiona las Áreas de Vinculación.
    -- Registra, modifica y elimina en base al parámetro pnAccion
    -- pnAccion = 1 : Registrar Área de Vinculación
    -- pnAccion = 2 : Actualizar Área de Vinculación
    -- pnAccion = 3 : Registrar edificio
	-- CASalgadoMontoya 2015-07-17 Basado en el SP de LDeras SP_GESTIONAR_EDIFCIOS 2015-07-04
    
    IN pnCodigoArea INT, -- Código de Área (En caso de que acción sea actualizar o eliminar)
    IN pcNombreArea VARCHAR(200), -- Nombre del Área de Vinculación
    IN pnCodigoFacultad INT, -- Código de la Facultad asociada al Área de Vinculación
    IN pnAccion INT, -- Parámetro para determinar qué acción se realizará
    OUT pcMensajeError VARCHAR(1000) -- Parámetro para los mensajes de error
)
SP: BEGIN

	DECLARE vnAccionRegistrar INT DEFAULT 1; -- Acción que determina registrar
    DECLARE vnAccionActualizar INT DEFAULT 2; -- Acción que determina actualizar
    DECLARE vnAccionEliminar INT DEFAULT 3; -- Acción que determina elimiinar


	DECLARE vcTempMensajeError VARCHAR(1000); -- Variable para anteponer los posibles mensajes de error

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
    
		ROLLBACK;
    
        SET vcTempMensajeError := CONCAT('Error: ', vcTempMensajeError);
        SET pcMensajeError := vcTempMensajeError;
    
    END;
    
    -- **********************************REGISTRAR ÁREA DE VINCULACIÓN********************************
    IF pnAccion = vnAccionRegistrar THEN 
    
		-- Determinar que el código de área no exista ya en la base.
        SET vcTempMensajeError := 'Error al determinar existencia del Área de Vinculación.';
        
        IF EXISTS
        (
			SELECT codigo
            FROM ca_vinculaciones
            WHERE codigo = pnCodigoArea
        )
        THEN
			BEGIN
            
				SET pcMensajeError := 'Ya existe un Área de Vinculación con este código, intentelo de nuevo con otro código.';
                LEAVE SP;
				
			END;
		END IF;
        
        START TRANSACTION;
        
        -- Registrar el área
        SET vcTempMensajeError := 'Error al registrar el Área de Vinculación. ';
        
        INSERT INTO ca_vinculaciones VALUES (pnCodigoArea, pcNombreArea, pnCodigoFacultad);
        
        COMMIT;
    
    -- **********************************ACTUALIZAR ÁREA********************************
    ELSEIF pnAccion = vnAccionActualizar THEN
    
		-- Determinar que el código del área no exista en la base de datos.
        SET vcTempMensajeError := 'Error al determinar existencia del Área de Vinculación.';
        
        IF NOT EXISTS
        (
			SELECT codigo
            FROM ca_vinculaciones
            WHERE codigo = pnCodigoArea
        )
        THEN
			BEGIN
            
				SET pcMensajeError := 'Ya existe un Área de Vinculación con este código, intentelo de nuevo con otro código.';
                LEAVE SP;
				
			END;
		END IF;   
        
        START TRANSACTION;
        
        -- Actualizar el nombre y/o facultad asociadas al área de Vinculación
        SET vcTempMensajeError := 'Error al actualizar la información del Área de Vinculación.';
        
		UPDATE ca_vinculaciones 
		SET 
			nombre = pcNombreArea,
            cod_facultad = pnCodigoFacultad
		WHERE
			codigo = pnCodigoArea;
        COMMIT;
    
    -- **********************************ELIMINAR AREA********************************
    ELSE
        
		-- Eliminar el edificio
        SET vcTempMensajeError := 'Error al eliminar el Área de Vinculación.';        
        
        START TRANSACTION;
        
		DELETE FROM ca_vinculaciones
		WHERE
			codigo = pnCodigoArea;
        COMMIT;
    
    END IF;
		
END;;